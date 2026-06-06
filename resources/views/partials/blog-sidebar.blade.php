<!-- Search -->
<div class="sidebar-widget" data-reveal="right">
  <div class="sw-header">
    <div class="sw-icon"><i class="bi bi-search"></i></div>
    <div class="sw-title">Cari Artikel</div>
  </div>
  <form action="{{ route('blog.search') }}" method="GET" class="sw-search-group">
    <input type="text" name="q" value="{{ request('q') }}" class="sw-search" id="sidebarSearch" placeholder="Ketik kata kunci…"/>
    <i class="bi bi-search sw-search-icon"></i>
  </form>
</div>

<!-- Popular Posts -->
<div class="sidebar-widget" data-reveal="right" data-reveal-delay="160">
  <div class="sw-header">
    <div class="sw-icon"><i class="bi bi-fire"></i></div>
    <div class="sw-title">Artikel Terpopuler</div>
  </div>
  @foreach($popularPosts as $post)
  <div class="pop-post" onclick="location.href='{{ route('blog.show', $post->slug) }}'">
    <div class="pop-thumb"><img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="lazy"/></div>
    <div>
      <div class="pop-cat">{{ $post->category->name ?? 'Uncategorized' }}</div>
      <div class="pop-title">{{ Str::limit($post->title, 50) }}</div>
      <div class="pop-date"><i class="bi bi-calendar3"></i>{{ $post->published_at->format('d M Y') }} · {{ $post->reading_time }} mnt</div>
    </div>
  </div>
  @endforeach
</div>

<!-- Tags -->
<div class="sidebar-widget" data-reveal="right" data-reveal-delay="200">
  <div class="sw-header">
    <div class="sw-icon"><i class="bi bi-tags-fill"></i></div>
    <div class="sw-title">Tag Populer</div>
  </div>
  <div class="tags-cloud">
    @foreach($tags as $tag)
    <span class="tag-chip" onclick="window.location.href='{{ route('blog.tag', $tag->slug) }}'">{{ $tag->name }}</span>
    @endforeach
  </div>
</div>
