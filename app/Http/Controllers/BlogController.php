<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\BlogSetting;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;

class BlogController extends Controller
{
    /**
     * Display blog listing page
     */
    public function index(Request $request)
    {
        // Get blog settings
        $blogSettings = BlogSetting::getInstance();

        // Get categories for filter
        $categories = BlogCategory::active()->orderBy('sort_order')->get();

        // Get featured post
        $featuredPost = BlogPost::published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->first();

        // Get posts with filters
        $query = BlogPost::published()
            ->with(['category', 'author']);

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Tag filter
        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('view_count', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            default:
                $query->latest('published_at');
        }

        $posts = $query->paginate(9)->withQueryString();

        // Get popular posts for sidebar
        $popularPosts = BlogPost::published()
            ->orderBy('view_count', 'desc')
            ->limit(3)
            ->get();

        // Get recent posts
        $recentPosts = BlogPost::published()
            ->latest('published_at')
            ->limit(5)
            ->get();

        // Get all tags for sidebar
        $tags = BlogTag::active()->get();

        // Calculate stats
        $totalPosts = BlogPost::published()->count();
        $totalCategories = BlogCategory::active()->count();
        $totalViews = BlogPost::published()->sum('view_count');

        return view('blog', compact(
            'blogSettings',
            'categories',
            'featuredPost',
            'posts',
            'popularPosts',
            'recentPosts',
            'tags',
            'totalPosts',
            'totalCategories',
            'totalViews'
        ));
    }

    /**
     * Display blog post detail
     */
    public function show($slug)
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->with(['category', 'author'])
            ->firstOrFail();

        // Increment view count
        $post->increment('view_count');

        // Get related posts (same category, excluding current)
        $relatedPosts = BlogPost::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(4)
            ->get();

        // If not enough related posts, get recent posts
        if ($relatedPosts->count() < 4) {
            $morePosts = BlogPost::published()
                ->where('id', '!=', $post->id)
                ->limit(4 - $relatedPosts->count())
                ->get();
            $relatedPosts = $relatedPosts->merge($morePosts);
        }

        // Get approved comments (not hidden) - load all with nested replies
        $comments = BlogComment::where('post_id', $post->id)
            ->where('is_approved', true)
            ->where('is_hidden', false)
            ->whereNull('parent_id')
            ->with(['replies' => function ($query) use ($post) {
                $query->where('is_approved', true)
                    ->where('is_hidden', false)
                    ->where('post_id', $post->id)
                    ->with('replies'); // Recursive loading for unlimited nesting
            }])
            ->latest()
            ->get();

        // Get popular posts for sidebar
        $popularPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->orderBy('view_count', 'desc')
            ->limit(3)
            ->get();

        // Get table of contents from content (extract h2 headings)
        $tableOfContents = $this->extractTableOfContents($post->content);

        return view('blog-detail', compact(
            'post',
            'relatedPosts',
            'comments',
            'popularPosts',
            'tableOfContents'
        ));
    }

    /**
     * Submit comment
     */
    public function submitComment(Request $request)
    {
        // Rate limiting: 3 comments per minute per IP
        if (RateLimiter::tooManyAttempts('submit-comment:'.$request->ip(), $maxAttempts = 3)) {
            $seconds = RateLimiter::availableIn('submit-comment:'.$request->ip());
            
            // Return JSON for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many comments submitted. Please try again in '.$seconds.' seconds.',
                ], 429);
            }
            
            return back()->with('error', 'Too many comments submitted. Please try again in '.$seconds.' seconds.');
        }

        RateLimiter::hit('submit-comment:'.$request->ip());

        $request->validate([
            'post_id' => 'required|exists:blog_posts,id',
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string|min:10|max:2000',
            'parent_id' => 'nullable|exists:blog_comments,id',
        ]);

        $comment = BlogComment::create([
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'content' => $request->content,
            'is_approved' => true, // Auto-approve comments
            'is_verified' => false,
            'is_official' => false,
            'is_hidden' => false,
        ]);

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment submitted successfully!',
                'comment' => [
                    'id' => $comment->id,
                    'author_name' => $comment->author_name,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'is_official' => $comment->is_official,
                ],
            ]);
        }

        return back()->with('success', 'Comment submitted successfully!');
    }

    /**
     * Like a comment
     */
    public function likeComment($commentId)
    {
        $comment = BlogComment::findOrFail($commentId);
        $comment->increment('likes');

        // Return JSON for AJAX requests
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'like_count' => $comment->likes,
            ]);
        }

        return back()->with('success', 'Comment liked!');
    }

    /**
     * Like a post
     */
    public function likePost($postId)
    {
        $post = BlogPost::findOrFail($postId);
        $post->increment('like_count');

        // Return JSON for AJAX requests
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'like_count' => $post->like_count,
            ]);
        }

        return back()->with('success', 'Post liked!');
    }

    /**
     * Search posts
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');
        $blogSettings = BlogSetting::getInstance();
        $categories = BlogCategory::active()->orderBy('sort_order')->get();
        $tags = BlogTag::active()->get();
        $popularPosts = BlogPost::published()->orderBy('view_count', 'desc')->limit(3)->get();
        $featuredPost = BlogPost::published()->featured()->with(['category', 'author'])->latest('published_at')->first();

        $posts = BlogPost::published()
            ->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            })
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(9);

        return view('blog', compact('blogSettings', 'featuredPost', 'posts', 'categories', 'tags', 'popularPosts', 'search'));
    }

    /**
     * Filter by category
     */
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $blogSettings = BlogSetting::getInstance();
        $categories = BlogCategory::active()->orderBy('sort_order')->get();
        $tags = BlogTag::active()->get();
        $popularPosts = BlogPost::published()->orderBy('view_count', 'desc')->limit(3)->get();
        $featuredPost = BlogPost::published()->featured()->with(['category', 'author'])->latest('published_at')->first();

        $posts = BlogPost::published()
            ->where('category_id', $category->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(9);

        return view('blog', compact('blogSettings', 'featuredPost', 'posts', 'categories', 'tags', 'popularPosts', 'category'));
    }

    /**
     * Filter by tag
     */
    public function tag($slug)
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();
        $blogSettings = BlogSetting::getInstance();
        $categories = BlogCategory::active()->orderBy('sort_order')->get();
        $tags = BlogTag::active()->get();
        $popularPosts = BlogPost::published()->orderBy('view_count', 'desc')->limit(3)->get();
        $featuredPost = BlogPost::published()->featured()->with(['category', 'author'])->latest('published_at')->first();

        $posts = BlogPost::published()
            ->whereJsonContains('tags', $slug)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(9);

        return view('blog', compact('blogSettings', 'featuredPost', 'posts', 'categories', 'tags', 'popularPosts', 'tag'));
    }

    /**
     * Extract table of contents from content (h2 headings)
     */
    private function extractTableOfContents($content)
    {
        preg_match_all('/<h2[^>]*id="([^"]*)"[^>]*>(.*?)<\/h2>/s', $content, $matches, PREG_SET_ORDER);

        $toc = [];
        foreach ($matches as $match) {
            $toc[] = [
                'id' => $match[1],
                'title' => strip_tags($match[2]),
            ];
        }

        return $toc;
    }
}
