@extends('layouts.app')

@section('title', $post->seo_title ?? $post->title . ' - Blog AROMAS')
@section('meta_description', $post->seo_description ?? Str::limit($post->excerpt, 160))

@if($post->seo_keywords)
<meta name="keywords" content="{{ $post->seo_keywords }}">
@endif

@section('content')
<div id="readProgress" class="read-progress"></div>

<!-- ═══════════ ARTICLE HERO ════════════ -->
<section class="article-hero">
  <div class="ah-bg"></div>
  <div class="ah-grain"></div>

  <div class="container">
    <div class="ah-inner">

      <!-- Category pill -->
      <div><span class="ah-cat-pill"><i class="bi {{ $post->category->icon ?? 'bi-lightbulb-fill' }}"></i> {{ $post->category->name ?? 'Uncategorized' }}</span></div>

      <!-- Title -->
      <h1 class="ah-title">
        {{ $post->title }}
      </h1>

      <!-- Excerpt -->
      <p class="ah-excerpt">
        {{ $post->excerpt }}
      </p>

      <!-- Meta -->
      <div class="ah-meta">
        <span class="ah-meta-item"><i class="bi bi-calendar3"></i> {{ $post->published_at->format('d M Y') }}</span>
        <span class="ah-meta-sep"></span>
        <span class="ah-meta-item"><i class="bi bi-clock"></i> {{ $post->reading_time }} menit baca</span>
        <span class="ah-meta-sep"></span>
        <span class="ah-meta-item"><i class="bi bi-eye"></i> {{ number_format($post->view_count/1000, 1) }}K pembaca</span>
      </div>

      <!-- Author -->
      <div>
        <div class="ah-author">
          @if($post->author && $post->author->avatar)
          <div class="ah-avatar" style="background-image:url('{{ Storage::url($post->author->avatar) }}');background-size:cover;background-position:center;"></div>
          @else
          <div class="ah-avatar">{{ $post->author->initials ?? substr($post->author->name ?? 'A', 0, 1) }}</div>
          @endif
          <div>
            <span class="ah-author-name">{{ $post->author->name ?? 'AROMAS' }}</span>
            <span class="ah-author-role">{{ $post->author->role ?? '' }}</span>
          </div>
        </div>
      </div>

      <!-- Hero image -->
      <div class="ah-img-wrap">
        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"/>
        <div class="ah-share">
          <button class="afs-btn" onclick="shareWA()" title="WhatsApp"><i class="bi bi-whatsapp"></i></button>
          <button class="afs-btn" onclick="shareFB()" title="Facebook"><i class="bi bi-facebook"></i></button>
          <button class="afs-btn" onclick="copyLink()" title="Salin link"><i class="bi bi-link-45deg"></i></button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- BREADCRUMB -->
<div class="bc-bar">
  <div class="container">
    <div class="bc-inner">
      <a href="{{ url('/') }}" class="bc-link"><i class="bi bi-house-door-fill"></i> Beranda</a>
      <span class="bc-sep"><i class="bi bi-chevron-right"></i></span>
      <a href="{{ route('blog.index') }}" class="bc-link">Blog</a>
      <span class="bc-sep"><i class="bi bi-chevron-right"></i></span>
      @if($post->category)
      <a href="{{ route('blog.category', $post->category->slug) }}" class="bc-link">{{ $post->category->name }}</a>
      <span class="bc-sep"><i class="bi bi-chevron-right"></i></span>
      @endif
      <span class="bc-current">{{ Str::limit($post->title, 30) }}…</span>
    </div>
  </div>
</div>

<!-- ARTICLE BODY -->
<div class="article-body">
  <div class="container">
    <div class="row g-5">

      <!-- CONTENT COLUMN -->
      <div class="col-lg-8">

        <!-- Prev / Next -->
        <div class="art-nav" data-reveal>
          @php
            $prevPost = \App\Models\BlogPost::published()->where('id', '<', $post->id)->orderBy('id', 'desc')->first();
            $nextPost = \App\Models\BlogPost::published()->where('id', '>', $post->id)->orderBy('id', 'asc')->first();
          @endphp
          @if($prevPost)
          <div class="art-nav-item" onclick="location.href='{{ route('blog.show', $prevPost->slug) }}'">
            <div class="art-nav-label"><i class="bi bi-arrow-left"></i> Sebelumnya</div>
            <div class="art-nav-title">{{ Str::limit($prevPost->title, 60) }}</div>
          </div>
          @endif
          @if($prevPost && $nextPost)
          <div class="art-nav-divider"></div>
          @endif
          @if($nextPost)
          <div class="art-nav-item next" onclick="location.href='{{ route('blog.show', $nextPost->slug) }}'">
            <div class="art-nav-label">Berikutnya <i class="bi bi-arrow-right"></i></div>
            <div class="art-nav-title">{{ Str::limit($nextPost->title, 60) }}</div>
          </div>
          @endif
        </div>

        <!-- ARTICLE CARD -->
        <div class="article-card" id="articleContent" data-reveal>
          {!! $post->content !!}
        </div>

        <!-- TAGS & SHARE -->
        <div class="article-footer" data-reveal>
          @if($post->tags && count($post->tags) > 0)
          <div class="tag-row">
            <span class="tag-row-label"><i class="bi bi-tags-fill"></i> Tags</span>
            @foreach($post->tags as $tag)
            <span class="tag-chip">#{{ ucfirst(str_replace('-', ' ', $tag)) }}</span>
            @endforeach
          </div>
          @endif
          <div class="share-row">
            <span class="share-label"><i class="bi bi-share-fill"></i> Bagikan:</span>
            <button class="share-btn wa" onclick="shareWA()"><i class="bi bi-whatsapp"></i> WhatsApp</button>
            <button class="share-btn fb" onclick="shareFB()"><i class="bi bi-facebook"></i> Facebook</button>
            <button class="share-btn tw" onclick="shareTW()"><i class="bi bi-twitter-x"></i> X</button>
            <button class="share-btn cp" onclick="copyLink()"><i class="bi bi-link-45deg"></i> Salin</button>
            <button type="button" class="like-btn" id="likeBtn" onclick="toggleLike({{ $post->id }})">
              <i class="bi bi-heart" id="likeIcon"></i>
              <span id="likeCount">{{ $post->like_count }}</span>
            </button>
          </div>
        </div>

        <!-- AUTHOR BOX -->
        @if($post->author)
        <div class="author-box" data-reveal>
          @if($post->author->avatar)
          <div class="author-avatar" style="background-image:url('{{ Storage::url($post->author->avatar) }}');background-size:cover;background-position:center;"></div>
          @else
          <div class="author-avatar">{{ $post->author->initials ?? substr($post->author->name ?? 'A', 0, 1) }}</div>
          @endif
          <div style="flex:1;">
            <div class="author-label">Tentang Penulis</div>
            <div class="author-name">{{ $post->author->name }}</div>
            <div class="author-role">{{ $post->author->role ?? '' }}</div>
            <p class="author-bio">{{ $post->author->bio ?? '' }}</p>
            @if($post->author->instagram || $post->author->linkedin || $post->author->twitter)
            <div class="author-socials">
              @if($post->author->instagram)
              <a href="https://instagram.com/{{ str_replace('@', '', $post->author->instagram) }}" class="author-soc" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
              @endif
              @if($post->author->linkedin)
              <a href="https://{{ $post->author->linkedin }}" class="author-soc" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
              @endif
              @if($post->author->twitter)
              <a href="https://twitter.com/{{ str_replace('@', '', $post->author->twitter) }}" class="author-soc" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
              @endif
            </div>
            @endif
          </div>
        </div>
        @endif

        <!-- COMMENTS -->
        <div class="comment-section" data-reveal>
          <div class="cs-header">
            <div class="cs-title">
              <i class="bi bi-chat-dots-fill"></i>
              Diskusi
              <span class="cs-count">{{ $comments->sum(fn($c) => 1 + ($c->replies ? $c->replies->sum(fn($r) => 1 + ($r->replies ? $r->replies->count() : 0)) : 0)) }} komentar</span>
            </div>
          </div>

          @if(session('success'))
          <div class="alert alert-success" style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
          </div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger" style="background:#f8d7da;border:1px solid #f5c6cb;color:#721c24;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            {{ session('error') }}
          </div>
          @endif

          <div class="comment-list">
            @forelse($comments as $comment)
              @include('partials.comment-item', ['comment' => $comment, 'isReply' => false, 'depth' => 1])
            @empty
              <p style="text-align:center;color:var(--g400);padding:40px 0;">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            @endforelse
          </div>

          <div class="comment-form">
            <div class="cf-header"><i class="bi bi-pencil-square"></i> Tinggalkan Komentar</div>
            
            <!-- Reply indicator -->
            <div id="replyIndicator" style="display:none;background:var(--g50);border:1.5px solid var(--sage);border-radius:var(--r8);padding:12px 16px;margin-bottom:16px;">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                <div style="display:flex;align-items:center;gap:8px;">
                  <i class="bi bi-reply-fill" style="color:var(--sage);font-size:1.1rem;"></i>
                  <div>
                    <div style="font-size:0.75rem;color:var(--g400);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Membalas komentar</div>
                    <div style="font-size:0.9rem;color:var(--ink);font-weight:700;" id="replyingToName">User</div>
                  </div>
                </div>
                <button type="button" onclick="cancelReply()" style="background:none;border:none;color:var(--g400);cursor:pointer;font-size:1.2rem;padding:4px;" title="Batal membalas">
                  <i class="bi bi-x-lg"></i>
                </button>
              </div>
            </div>
            
            <form id="commentForm" onsubmit="submitComment(event)">
              <input type="hidden" name="post_id" value="{{ $post->id }}">
              <input type="hidden" name="parent_id" id="parentCommentId" value="">
              <div class="cf-grid">
                <div class="cf-field">
                  <label>Nama Lengkap *</label>
                  <input type="text" name="author_name" id="cmName" placeholder="cth. Budi Santoso" required/>
                </div>
                <div class="cf-field">
                  <label>Email *</label>
                  <input type="email" name="author_email" id="cmEmail" placeholder="email@contoh.com" required/>
                </div>
              </div>
              <div class="cf-field">
                <label>Komentar *</label>
                <textarea name="content" id="cmText" placeholder="Bagikan pendapat, pertanyaan, atau pengalaman Anda…" required minlength="10" maxlength="2000"></textarea>
                <small id="charCount" style="color: var(--g400); font-size: 0.75rem;">0/2000 characters</small>
              </div>
              <button type="submit" class="btn-comment" id="submitBtn">
                <i class="bi bi-send-fill"></i> Kirim Komentar
              </button>
            </form>
          </div>
        </div>

      </div><!-- /col-lg-8 -->

      <!-- SIDEBAR -->
      <div class="col-lg-4">
        @if($tableOfContents && count($tableOfContents) > 0)
        <div class="sidebar-widget toc-widget" data-reveal="right">
          <div class="sw-head">
            <div class="sw-icon"><i class="bi bi-list-ul"></i></div>
            <div class="sw-title">Daftar Isi</div>
          </div>
          <ul class="toc-list" id="tocList">
            @foreach($tableOfContents as $item)
            <li class="toc-item"><a href="#{{ $item['id'] }}" class="toc-link" onclick="goTo('{{ $item['id'] }}');return false;">{{ $item['title'] }}</a></li>
            @endforeach
          </ul>
          <div class="toc-progress">
            <div class="toc-prog-row">
              <span>Progres Membaca</span>
              <span id="tocPct">0%</span>
            </div>
            <div class="toc-track"><div class="toc-fill" id="tocFill"></div></div>
          </div>
        </div>
        @endif

        <div class="sidebar-widget" data-reveal="right" data-reveal-delay="80">
          <div class="sw-head">
            <div class="sw-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
            <div class="sw-title">Artikel Terkait</div>
          </div>
          @foreach($relatedPosts as $related)
          <div class="related-item" onclick="location.href='{{ route('blog.show', $related->slug) }}'">
            <div class="ri-thumb"><img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" loading="lazy"/></div>
            <div>
              <div class="ri-cat">{{ $related->category->name ?? 'Uncategorized' }}</div>
              <div class="ri-title">{{ Str::limit($related->title, 50) }}</div>
              <div class="ri-date"><i class="bi bi-calendar3"></i> {{ $related->published_at->format('d M Y') }}</div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
  </div>
</div>

<div id="toast" class="toast-el"></div>

<button id="backTop" class="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="bi bi-arrow-up"></i></button>
@endsection

@push('styles')
<style>
/* ─── ROOT ───────────────────────────────────────── */
:root{
  --forest:#0B2A1A;--forest-deep:#071910;--forest-mid:#143320;--forest-light:#1E4A2E;
  --sage:#2E7D4E;--sage-lt:#3D9E63;
  --gold:#C8970A;--gold-lt:#E8B524;--gold-pale:#F5D97A;--gold-cream:#FBF3D9;
  --cream:#FDFAF2;--cream-dk:#F5EDD8;
  --ink:#0F1A12;
  --white:#FFFFFF;
  --g50:#F9FAF7;--g100:#EFF0EB;--g200:#D9DBD3;--g300:#C4C9BC;
  --g400:#9FA79A;--g500:#7A8475;--g600:#5A6357;--g700:#3D4A3A;--g800:#2E3529;
  --ff-serif:'Cormorant Garamond',Georgia,serif;
  --ff-display:'DM Serif Display',Georgia,serif;
  --ff-body:'DM Sans',system-ui,sans-serif;
  --ease-out:cubic-bezier(0.16,1,0.3,1);
  --ease-spring:cubic-bezier(0.34,1.56,0.64,1);
  --r4:4px;--r8:8px;--r12:12px;--r16:16px;--r20:20px;--r24:24px;
  --sh-xs:0 1px 3px rgba(0,0,0,.05),0 1px 2px rgba(0,0,0,.04);
  --sh-sm:0 2px 10px rgba(0,0,0,.07),0 1px 4px rgba(0,0,0,.05);
  --sh-md:0 8px 32px rgba(0,0,0,.09),0 2px 8px rgba(0,0,0,.05);
  --sh-lg:0 20px 64px rgba(0,0,0,.11),0 4px 16px rgba(0,0,0,.06);
  --sh-gold:0 6px 24px rgba(200,151,10,.28);
  --sh-green:0 6px 24px rgba(46,125,78,.22);
}

/* ─── READING PROGRESS ───────────────────────────── */
.read-progress{position:fixed;top:0;left:0;height:3px;width:0%;
  background:linear-gradient(90deg,var(--sage),var(--gold-lt),var(--sage-lt));
  z-index:100001;transition:width .1s linear;box-shadow:0 0 10px rgba(46,125,78,.5);}

/* ─── ARTICLE HERO — simplified ─────────────────── */
.article-hero{
  position:relative;
  background:var(--forest-deep);
  overflow:hidden;
  padding:110px 0 0;
}
.ah-bg{
  position:absolute;inset:0;pointer-events:none;
  background:
    radial-gradient(ellipse 60% 70% at 80% 20%,rgba(200,151,10,.10) 0%,transparent 55%),
    radial-gradient(ellipse 50% 60% at 10% 80%,rgba(46,125,78,.12) 0%,transparent 50%);
}
.ah-grain{position:absolute;inset:0;opacity:.025;pointer-events:none;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  background-size:200px;}

.ah-inner{position:relative;z-index:2;text-align:center;padding:40px 0 0;}

.ah-cat-pill{display:inline-flex;align-items:center;gap:6px;
  background:linear-gradient(135deg,var(--gold),var(--gold-lt));
  color:var(--forest);padding:5px 16px;border-radius:50px;
  font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;
  margin-bottom:20px;
  animation:fadeUp .7s var(--ease-out) both;}

.ah-title{
  font-size:clamp(1.9rem,4.5vw,3.1rem);
  color:#fff;font-family:var(--ff-display);line-height:1.16;
  font-style:italic;margin-bottom:16px;
  animation:fadeUp .75s var(--ease-out) .07s both;
}
.ah-title em{color:var(--gold-lt);font-style:normal;}

.ah-excerpt{
  font-size:.95rem;color:rgba(255,255,255,.55);line-height:1.85;
  max-width:580px;margin:0 auto 28px;
  animation:fadeUp .8s var(--ease-out) .14s both;
}

.ah-meta{display:flex;align-items:center;justify-content:center;gap:8px;flex-wrap:wrap;
  margin-bottom:28px;animation:fadeUp .8s var(--ease-out) .2s both;}
.ah-meta-item{display:inline-flex;align-items:center;gap:5px;
  font-size:.75rem;color:rgba(255,255,255,.45);}
.ah-meta-item i{font-size:.7rem;color:rgba(200,151,10,.65);}
.ah-meta-sep{width:3px;height:3px;border-radius:50%;background:rgba(255,255,255,.18);}

.ah-author{display:inline-flex;align-items:center;gap:12px;
  padding:12px 20px;border-radius:var(--r16);
  background:rgba(255,255,255,.06);border:1px solid rgba(200,151,10,.16);
  margin-bottom:36px;animation:fadeUp .85s var(--ease-out) .26s both;}
.ah-avatar{width:42px;height:42px;border-radius:10px;flex-shrink:0;
  background:linear-gradient(135deg,var(--gold),var(--gold-lt));
  display:flex;align-items:center;justify-content:center;
  font-family:var(--ff-display);font-size:1.1rem;color:var(--forest);}
.ah-author-name{font-size:.83rem;font-weight:700;color:#fff;display:block;text-align:left;}
.ah-author-role{font-size:.7rem;color:rgba(255,255,255,.4);display:block;margin-top:1px;text-align:left;}

.ah-img-wrap{
  position:relative;
  height:400px;
  max-width:860px;
  margin:0 auto;
  border-radius:16px 16px 0 0;
  overflow:hidden;
  animation:fadeUp 1s var(--ease-out) .32s both;
}
.ah-img-wrap img{width:100%;height:100%;object-fit:cover;}
.ah-img-wrap::after{content:'';position:absolute;inset:0;
  background:linear-gradient(to bottom,transparent 60%,rgba(7,25,16,.55));}

.ah-share{position:absolute;bottom:16px;right:16px;z-index:5;display:flex;gap:7px;}
.afs-btn{width:34px;height:34px;border-radius:var(--r8);
  background:rgba(7,25,16,.65);backdrop-filter:blur(8px);
  border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;
  color:rgba(255,255,255,.75);font-size:.82rem;cursor:pointer;transition:all .2s;}
.afs-btn:hover{background:var(--gold);color:var(--forest);border-color:transparent;transform:translateY(-2px);}

@keyframes fadeUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:translateY(0);}}

/* ─── BREADCRUMB ─────────────────────────────────── */
.bc-bar{background:var(--cream-dk);border-bottom:1px solid rgba(0,0,0,.06);padding:12px 0;}
.bc-inner{display:flex;align-items:center;gap:7px;font-size:.78rem;color:var(--g400);flex-wrap:wrap;}
.bc-link{color:var(--sage);font-weight:500;transition:color .2s;}
.bc-link:hover{color:var(--gold);}
.bc-sep{color:var(--g200);}
.bc-current{color:var(--g500);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:260px;}

/* ─── ARTICLE BODY ───────────────────────────────── */
.article-body{padding:52px 0 80px;background:var(--cream);}

.art-nav{display:grid;grid-template-columns:1fr 1px 1fr;background:var(--white);
  border-radius:var(--r20);border:1px solid rgba(0,0,0,.05);
  box-shadow:var(--sh-xs);overflow:hidden;margin-bottom:28px;}
.art-nav-item{padding:20px 22px;cursor:pointer;display:flex;flex-direction:column;transition:background .22s;}
.art-nav-item:hover{background:rgba(46,125,78,.04);}
.art-nav-item.next{align-items:flex-end;text-align:right;}
.art-nav-divider{background:var(--g100);}
.art-nav-label{font-size:.67rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;
  color:var(--g300);display:flex;align-items:center;gap:5px;margin-bottom:5px;}
.art-nav-item.next .art-nav-label{flex-direction:row-reverse;}
.art-nav-title{font-size:.8rem;font-weight:600;color:var(--g600);line-height:1.45;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;transition:color .2s;}
.art-nav-item:hover .art-nav-title{color:var(--forest);}

.article-card{background:var(--white);border-radius:24px;
  border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-md);
  padding:52px 56px;margin-bottom:24px;}
.article-card h2{font-family:var(--ff-display);font-size:1.7rem;color:var(--ink);
  margin:44px 0 16px;padding-bottom:14px;position:relative;border-bottom:1.5px solid var(--g100);}
.article-card h2::after{content:'';position:absolute;bottom:-1.5px;left:0;
  width:48px;height:1.5px;background:linear-gradient(to right,var(--sage),var(--gold));}
.article-card h3{font-size:1.15rem;font-family:var(--ff-body);font-weight:700;color:var(--forest);margin:28px 0 11px;}
.article-card p{font-size:.96rem;color:var(--g600);line-height:1.95;margin-bottom:18px;}
.article-card strong{color:var(--g800);font-weight:700;}
.article-card a{color:var(--sage);border-bottom:1px solid rgba(46,125,78,.25);}
.article-card a:hover{color:var(--gold);border-color:var(--gold);}
.article-card ul,.article-card ol{list-style:none;padding:0;margin:0 0 20px;}
.article-card ul li,.article-card ol li{font-size:.94rem;color:var(--g600);line-height:1.85;margin-bottom:10px;display:flex;align-items:flex-start;gap:12px;}
.article-card ul li::before{content:'';width:7px;height:7px;border-radius:50%;background:linear-gradient(135deg,var(--sage),var(--gold));margin-top:8px;flex-shrink:0;}
.article-card ol{counter-reset:ol-c;}
.article-card ol li{counter-increment:ol-c;}
.article-card ol li::before{content:counter(ol-c);width:24px;height:24px;border-radius:var(--r8);flex-shrink:0;background:linear-gradient(135deg,var(--forest),var(--sage));color:#fff;font-size:.72rem;font-weight:700;display:flex;align-items:center;justify-content:center;margin-top:2px;}

.callout{display:flex;gap:16px;padding:20px 22px;border-radius:var(--r16);margin:28px 0;align-items:flex-start;}
.callout.info{background:rgba(200,151,10,.07);border:1.5px solid rgba(200,151,10,.22);}
.callout.warn{background:rgba(220,53,69,.06);border:1.5px solid rgba(220,53,69,.2);}
.callout.success{background:rgba(46,125,78,.07);border:1.5px solid rgba(46,125,78,.2);}
.callout-icon{width:38px;height:38px;border-radius:var(--r8);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.95rem;}
.callout.info .callout-icon{background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--forest);}
.callout.warn .callout-icon{background:linear-gradient(135deg,#dc3545,#c82333);color:#fff;}
.callout.success .callout-icon{background:linear-gradient(135deg,var(--sage),var(--forest));color:#fff;}
.callout-title{font-size:.84rem;font-weight:700;color:var(--ink);margin-bottom:4px;}
.callout-text{font-size:.83rem;color:var(--g500);line-height:1.72;margin:0;}

.pull-quote{position:relative;padding:28px 32px 28px 44px;margin:36px 0;border-radius:0 var(--r16) var(--r16) 0;background:linear-gradient(135deg,rgba(46,125,78,.06),rgba(200,151,10,.04));border-left:4px solid var(--sage);}
.pull-quote::before{content:'\201C';position:absolute;top:-8px;left:14px;font-family:var(--ff-display);font-size:5rem;color:var(--sage);opacity:.18;line-height:1;}
.pull-quote p{font-family:var(--ff-serif);font-size:1.18rem;font-style:italic;color:var(--forest);line-height:1.7;margin:0 0 10px;}
.pull-quote cite{font-size:.78rem;color:var(--g400);font-style:normal;display:flex;align-items:center;gap:8px;}
.pull-quote cite::before{content:'';width:20px;height:1.5px;background:var(--gold);}

.compare-wrap{margin:28px 0;border-radius:var(--r16);overflow:hidden;box-shadow:var(--sh-sm);}
.compare-table{width:100%;border-collapse:collapse;font-size:.84rem;}
.compare-table thead tr{background:linear-gradient(135deg,var(--forest),var(--sage));}
.compare-table thead th{color:#fff;padding:14px 18px;font-weight:700;text-align:left;font-size:.76rem;text-transform:uppercase;letter-spacing:.7px;}
.compare-table tbody tr{border-bottom:1px solid var(--g100);background:var(--white);transition:background .18s;}
.compare-table tbody tr:hover{background:rgba(46,125,78,.04);}
.compare-table tbody tr:nth-child(even){background:var(--g50);}
.compare-table td{padding:12px 18px;color:var(--g600);vertical-align:middle;}
.compare-table td:first-child{font-weight:600;color:var(--g800);}
.badge-pill{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:50px;font-size:.68rem;font-weight:700;}
.badge-pill.green{background:rgba(46,125,78,.1);color:var(--sage);}
.badge-pill.gold{background:rgba(200,151,10,.12);color:#9B6F00;}
.tc-good{color:var(--sage);font-weight:700;}
.tc-warn{color:#c05800;font-weight:700;}

.art-img{margin:36px 0;}
.art-img img{width:100%;border-radius:var(--r16);max-height:380px;object-fit:cover;box-shadow:var(--sh-md);}
.art-img figcaption{text-align:center;font-size:.75rem;color:var(--g300);margin-top:10px;font-style:italic;display:flex;align-items:center;justify-content:center;gap:6px;}

.takeaways{border-radius:var(--r20);overflow:hidden;margin:40px 0;}
.takeaways-header{background:linear-gradient(135deg,var(--forest-deep),var(--forest));padding:20px 28px;display:flex;align-items:center;gap:12px;}
.takeaways-header i{font-size:1.3rem;color:var(--gold-lt);}
.takeaways-header span{font-family:var(--ff-display);font-size:1.1rem;color:#fff;}
.takeaways-body{background:linear-gradient(to bottom,var(--forest-mid),var(--forest-light));padding:24px 28px;display:flex;flex-direction:column;gap:14px;}
.takeaway-row{display:flex;align-items:flex-start;gap:13px;font-size:.88rem;color:rgba(255,255,255,.78);line-height:1.7;}
.takeaway-num{width:28px;height:28px;border-radius:var(--r8);flex-shrink:0;background:rgba(200,151,10,.22);border:1px solid rgba(200,151,10,.35);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:var(--gold-lt);}

.article-footer{background:var(--white);border-radius:var(--r20);border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);padding:26px 28px;margin-bottom:22px;}
.tag-row{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:20px;padding-bottom:18px;border-bottom:1px solid var(--g50);}
.tag-row-label{font-size:.73rem;font-weight:700;color:var(--g300);display:flex;align-items:center;gap:5px;white-space:nowrap;}
.tag-chip{padding:5px 14px;border-radius:50px;font-size:.72rem;font-weight:600;background:var(--g50);color:var(--g500);border:1.5px solid var(--g100);cursor:pointer;transition:all .2s;}
.tag-chip:hover{background:var(--forest);color:#fff;border-color:var(--forest);}
.share-row{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.share-label{font-size:.78rem;font-weight:700;color:var(--g400);white-space:nowrap;display:flex;align-items:center;gap:5px;}
.share-btn{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;border-radius:var(--r8);font-size:.77rem;font-weight:700;color:#fff;cursor:pointer;border:none;transition:all .22s;}
.share-btn:hover{transform:translateY(-2px);}
.share-btn.wa{background:linear-gradient(135deg,#25d366,#0fa855);}
.share-btn.fb{background:linear-gradient(135deg,#1877f2,#0d5cba);}
.share-btn.tw{background:linear-gradient(135deg,#111,#333);}
.share-btn.cp{background:linear-gradient(135deg,var(--sage),var(--forest));}
.like-btn{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;border-radius:var(--r8);font-size:.82rem;font-weight:700;color:var(--g400);background:var(--g50);border:1.5px solid var(--g100);cursor:pointer;transition:all .22s;margin-left:auto;}
.like-btn:hover,.like-btn.liked{background:rgba(220,53,69,.07);color:#c82333;border-color:rgba(220,53,69,.25);}
.like-btn i{transition:transform .25s var(--ease-spring);}
.like-btn:hover i,.like-btn.liked i{transform:scale(1.25);}

.author-box{display:flex;gap:24px;background:var(--white);border-radius:var(--r20);border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);padding:28px;margin-bottom:22px;align-items:flex-start;}
.author-avatar{width:80px;height:80px;border-radius:18px;flex-shrink:0;background:linear-gradient(135deg,var(--forest),var(--sage));display:flex;align-items:center;justify-content:center;font-family:var(--ff-display);font-size:2rem;color:#fff;box-shadow:0 6px 20px rgba(46,125,78,.28);}
.author-label{font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:var(--gold);margin-bottom:4px;}
.author-name{font-size:1.1rem;font-family:var(--ff-display);color:var(--ink);margin-bottom:2px;}
.author-role{font-size:.78rem;color:var(--g300);margin-bottom:12px;}
.author-bio{font-size:.84rem;color:var(--g500);line-height:1.8;margin-bottom:16px;}
.author-socials{display:flex;gap:8px;}
.author-soc{width:32px;height:32px;border-radius:var(--r8);background:var(--g50);border:1.5px solid var(--g100);display:flex;align-items:center;justify-content:center;color:var(--g400);font-size:.85rem;cursor:pointer;transition:all .2s;}
.author-soc:hover{background:var(--forest);color:#fff;border-color:var(--forest);}

.comment-section{background:var(--white);border-radius:var(--r20);border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);padding:32px;margin-bottom:22px;}
.cs-header{display:flex;align-items:center;margin-bottom:28px;padding-bottom:18px;border-bottom:1.5px solid var(--g50);}
.cs-title{display:flex;align-items:center;gap:10px;font-size:1.05rem;font-family:var(--ff-display);color:var(--ink);}
.cs-title i{color:var(--gold);}
.cs-count{padding:3px 12px;border-radius:50px;background:rgba(46,125,78,.1);color:var(--sage);font-size:.72rem;font-weight:700;}
.comment-list{display:flex;flex-direction:column;gap:22px;margin-bottom:32px;}
.comment-item{display:flex;gap:14px;}
.cm-avatar{width:42px;height:42px;border-radius:12px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-display);font-size:.95rem;font-weight:700;color:#fff;}
.cm-content{flex:1;}
.cm-head{display:flex;align-items:center;gap:9px;flex-wrap:wrap;margin-bottom:8px;}
.cm-name{font-size:.86rem;font-weight:700;color:var(--ink);}
.cm-date{font-size:.71rem;color:var(--g300);}
.cm-badge{padding:2px 9px;border-radius:50px;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;}
.cm-badge.official{background:rgba(46,125,78,.12);color:var(--sage);}
.cm-badge.verified{background:rgba(200,151,10,.12);color:#9B6F00;}
.cm-bubble{font-size:.84rem;color:var(--g500);line-height:1.8;background:var(--g50);border-radius:0 var(--r16) var(--r16) var(--r16);padding:14px 18px;border:1px solid var(--g100);}
.cm-bubble.official-bubble{background:rgba(46,125,78,.06);border-color:rgba(46,125,78,.15);}
.cm-actions{display:flex;gap:14px;margin-top:8px;}
.cm-action{background:none;border:none;font-size:.72rem;font-weight:600;color:var(--g300);cursor:pointer;display:flex;align-items:center;gap:4px;font-family:var(--ff-body);transition:all .2s;padding:0;}
.cm-action:hover{color:var(--sage);}
.cm-action.liked{color:#c82333;}
.cm-action.liked i{animation:likeBounce 0.4s ease;}
@keyframes likeBounce{0%,100%{transform:scale(1);}50%{transform:scale(1.3);}}
.comment-reply{margin-left:28px;margin-top:14px;padding-left:14px;border-left:2px solid var(--g200);}
.comment-reply .comment-item{margin-bottom:14px;}
.comment-reply .cm-avatar{width:36px;height:36px;font-size:.7rem;}
.comment-reply .comment-reply{margin-left:28px;}
.comment-form{background:var(--g50);border-radius:var(--r16);padding:26px;border:1px solid var(--g100);}
.cf-header{font-size:.9rem;font-weight:700;color:var(--ink);display:flex;align-items:center;gap:8px;margin-bottom:18px;}
.cf-header i{color:var(--gold);}
.cf-grid{display:grid;grid-template-columns:1fr 1fr;gap:13px;margin-bottom:13px;}
.cf-field label{display:block;font-size:.73rem;font-weight:700;color:var(--g400);margin-bottom:6px;text-transform:uppercase;letter-spacing:.8px;}
.cf-field input,.cf-field textarea{width:100%;padding:10px 14px;border-radius:var(--r8);border:1.5px solid var(--g100);background:#fff;font-family:var(--ff-body);font-size:.84rem;color:var(--ink);outline:none;transition:all .22s;}
.cf-field input:focus,.cf-field textarea:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(46,125,78,.1);}
.cf-field textarea{resize:vertical;min-height:110px;margin-bottom:13px;}
.btn-comment{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--forest),var(--sage));color:#fff;border:none;border-radius:var(--r8);padding:11px 24px;font-family:var(--ff-body);font-size:.84rem;font-weight:700;cursor:pointer;transition:all .25s var(--ease-out);}
.btn-comment:hover{transform:translateY(-2px);box-shadow:var(--sh-green);}

.sidebar-widget{background:var(--white);border-radius:var(--r20);border:1px solid rgba(0,0,0,.05);box-shadow:var(--sh-xs);padding:24px 22px;margin-bottom:18px;}
.sw-head{display:flex;align-items:center;gap:9px;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--g50);}
.sw-icon{width:30px;height:30px;border-radius:var(--r8);background:linear-gradient(135deg,var(--gold),var(--gold-lt));display:flex;align-items:center;justify-content:center;color:var(--forest);font-size:.78rem;flex-shrink:0;}
.sw-title{font-size:.87rem;font-weight:700;color:var(--ink);}
.toc-widget{position:sticky;top:90px;}
.toc-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:2px;}
.toc-item{border-left:2px solid var(--g100);padding-left:14px;transition:border-color .22s;}
.toc-item.active{border-color:var(--sage);}
.toc-link{font-size:.8rem;color:var(--g400);display:block;padding:5px 0;line-height:1.5;transition:all .2s;}
.toc-item.active .toc-link,.toc-link:hover{color:var(--forest);font-weight:600;}
.toc-progress{margin-top:18px;padding-top:16px;border-top:1px dashed var(--g100);}
.toc-prog-row{display:flex;justify-content:space-between;font-size:.72rem;color:var(--g300);margin-bottom:7px;}
.toc-track{height:5px;background:var(--g100);border-radius:3px;overflow:hidden;}
.toc-fill{height:100%;width:0%;border-radius:3px;background:linear-gradient(to right,var(--sage),var(--gold-lt));transition:width .15s linear;}
.related-item{display:flex;gap:12px;padding:11px 0;border-bottom:1px solid var(--g50);cursor:pointer;transition:transform .22s;}
.related-item:last-child{border-bottom:0;padding-bottom:0;}
.related-item:hover{transform:translateX(4px);}
.ri-thumb{width:62px;height:54px;border-radius:var(--r8);overflow:hidden;flex-shrink:0;}
.ri-thumb img{width:100%;height:100%;object-fit:cover;transition:transform .35s;}
.related-item:hover .ri-thumb img{transform:scale(1.08);}
.ri-cat{font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--gold);margin-bottom:3px;}
.ri-title{font-size:.78rem;font-weight:600;color:var(--g700);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;transition:color .2s;}
.related-item:hover .ri-title{color:var(--forest);}
.ri-date{font-size:.66rem;color:var(--g200);margin-top:3px;display:flex;align-items:center;gap:4px;}
.nl-sidebar{border-radius:var(--r20);overflow:hidden;margin-bottom:18px;background:linear-gradient(160deg,var(--forest-deep),var(--forest-mid));position:relative;}
.nl-deco{position:absolute;top:-40px;right:-40px;width:160px;height:160px;border-radius:50%;border:1.5px solid rgba(200,151,10,.12);}
.nl-deco2{position:absolute;bottom:-30px;left:-30px;width:130px;height:130px;border-radius:50%;border:1.5px solid rgba(46,125,78,.15);}
.nl-inner{position:relative;z-index:1;padding:26px 22px;}
.nl-icon{width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,var(--gold),var(--gold-lt));display:flex;align-items:center;justify-content:center;color:var(--forest);font-size:1rem;margin-bottom:12px;}
.nl-title{font-size:1rem;font-family:var(--ff-display);color:#fff;margin-bottom:6px;}
.nl-desc{font-size:.78rem;color:rgba(255,255,255,.5);line-height:1.72;margin-bottom:16px;}
.nl-input{width:100%;padding:10px 13px;border-radius:var(--r8);border:1.5px solid rgba(255,255,255,.12);background:rgba(255,255,255,.08);color:#fff;font-family:var(--ff-body);font-size:.82rem;outline:none;margin-bottom:9px;transition:border-color .22s;}
.nl-input::placeholder{color:rgba(255,255,255,.3);}
.nl-input:focus{border-color:var(--gold-lt);}
.nl-btn{width:100%;padding:10px;border-radius:var(--r8);border:none;cursor:pointer;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--forest);font-family:var(--ff-body);font-size:.83rem;font-weight:700;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .25s var(--ease-out);}
.nl-btn:hover{transform:translateY(-2px);box-shadow:var(--sh-gold);}
.nl-privacy{font-size:.62rem;color:rgba(255,255,255,.28);text-align:center;margin-top:8px;display:flex;align-items:center;justify-content:center;gap:5px;}

.toast-el{position:fixed;bottom:110px;left:50%;transform:translateX(-50%) translateY(20px);
  background:linear-gradient(135deg,var(--forest),var(--sage));color:#fff;
  padding:12px 24px;border-radius:var(--r12);font-size:.84rem;font-weight:600;
  z-index:9999;box-shadow:0 8px 28px rgba(46,125,78,.4);
  opacity:0;transition:all .3s var(--ease-out);
  white-space:nowrap;max-width:90vw;text-align:center;pointer-events:none;}
.toast-el.show{opacity:1;transform:translateX(-50%) translateY(0);}

[data-reveal]{opacity:0;transform:translateY(20px);transition:opacity .7s var(--ease-out),transform .7s var(--ease-out);}
[data-reveal="right"]{transform:translateX(20px);}
[data-reveal].revealed{opacity:1;transform:none;}

.back-to-top{position:fixed;bottom:30px;right:30px;width:46px;height:46px;border-radius:50%;
  background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--forest);
  display:flex;align-items:center;justify-content:center;font-size:1.2rem;
  cursor:pointer;box-shadow:var(--sh-gold);opacity:0;pointer-events:none;
  transition:all .3s var(--ease-out);z-index:999;}
.back-to-top.show{opacity:1;pointer-events:auto;}
.back-to-top:hover{transform:translateY(-4px);box-shadow:0 8px 32px rgba(200,151,10,.4);}

@media(max-width:991.98px){
  .article-card{padding:28px 24px;}
  .author-box{flex-direction:column;gap:16px;}
  .author-avatar{width:64px;height:64px;font-size:1.5rem;}
  .art-nav{grid-template-columns:1fr;}.art-nav-divider{height:1px;}
  .art-nav-item.next{align-items:flex-start;text-align:left;}
  .art-nav-item.next .art-nav-label{flex-direction:row;}
  .toc-widget{position:static;}
  .ah-img-wrap{height:240px;}
}
@media(max-width:767.98px){
  .article-card{padding:20px 16px;}
  .cf-grid{grid-template-columns:1fr;}
  .comment-reply{margin-left:30px;}
  .share-row{gap:6px;}
  .share-btn{padding:8px 12px;font-size:.72rem;}
  .ah-img-wrap{height:200px;}
  .ah-title{font-size:1.75rem;}
  .comment-section{padding:24px 18px;}
}
</style>
@endpush

@push('scripts')
<script>
/* ─── REVEAL ANIMATION ───────────────────────────── */
function initReveal(){
  const els=document.querySelectorAll('[data-reveal]');
  const obs=new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(!e.isIntersecting)return;
      const d=parseInt(e.target.dataset.revealDelay||0);
      setTimeout(()=>e.target.classList.add('revealed'),d);
      obs.unobserve(e.target);
    });
  },{threshold:0.1,rootMargin:'0px 0px -36px 0px'});
  els.forEach(el=>obs.observe(el));
}

/* ─── READING PROGRESS ───────────────────────────── */
function initReadProgress(){
  const bar=document.getElementById('readProgress');
  const fill=document.getElementById('tocFill');
  const pct=document.getElementById('tocPct');
  window.addEventListener('scroll',()=>{
    const total=document.documentElement.scrollHeight-window.innerHeight;
    const progress=total>0?Math.min(100,Math.round(scrollY/total*100)):0;
    if(bar)bar.style.width=progress+'%';
    if(fill)fill.style.width=progress+'%';
    if(pct)pct.textContent=progress+'%';
  },{passive:true});
}

/* ─── TABLE OF CONTENTS ──────────────────────────── */
function initTOC(){
  const ids=['h-1','h-2','h-3','h-4','h-5'];
  const items=document.querySelectorAll('.toc-item');
  window.addEventListener('scroll',()=>{
    let current='';
    ids.forEach(id=>{
      const el=document.getElementById(id);
      if(el&&scrollY>=el.getBoundingClientRect().top+pageYOffset-130)current=id;
    });
    items.forEach((li,i)=>li.classList.toggle('active','h-'+(i+1)===current));
  },{passive:true});
}

function goTo(id){
  const el=document.getElementById(id);
  if(!el)return;
  window.scrollTo({top:el.getBoundingClientRect().top+pageYOffset-100,behavior:'smooth'});
}

/* ─── LIKE ───────────────────────────────────────── */
let liked=false;
let likeProcessing=false;

function toggleLike(postId){
  if(likeProcessing) return; // Prevent double-clicking
  
  likeProcessing=true;
  const btn=document.getElementById('likeBtn');
  const icon=document.getElementById('likeIcon');
  const countEl=document.getElementById('likeCount');
  let count=parseInt(countEl.textContent)||0;
  
  // Optimistic UI update
  liked=!liked;
  btn.classList.toggle('liked',liked);
  icon.classList.toggle('bi-heart',!liked);
  icon.classList.toggle('bi-heart-fill',liked);
  countEl.textContent=liked?count+1:count-1;
  
  // Send AJAX request
  fetch(`/blog/${postId}/like`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json',
    },
    body: JSON.stringify({ liked: liked }),
  })
  .then(response => response.json())
  .then(data => {
    if(data.success){
      countEl.textContent=data.like_count;
      toast('✓ Terima kasih sudah menyukai artikel ini!');
    } else {
      // Revert on error
      liked=!liked;
      btn.classList.toggle('liked',liked);
      icon.classList.toggle('bi-heart',!liked);
      icon.classList.toggle('bi-heart-fill',liked);
      countEl.textContent=liked?count+1:count-1;
      toast('✗ Gagal menyimpan like. Silakan coba lagi.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    // Revert on error
    liked=!liked;
    btn.classList.toggle('liked',liked);
    icon.classList.toggle('bi-heart',!liked);
    icon.classList.toggle('bi-heart-fill',liked);
    countEl.textContent=liked?count+1:count-1;
    toast('✗ Terjadi kesalahan. Silakan coba lagi.');
  })
  .finally(() => {
    likeProcessing=false;
  });
}

/* ─── COMMENT LIKE ───────────────────────────────── */
let commentLikeProcessing=false;

function toggleCommentLike(commentId, button){
  if(commentLikeProcessing) return; // Prevent double-clicking
  
  commentLikeProcessing=true;
  const likeCountSpan=button.querySelector('.like-count');
  const icon=button.querySelector('i');
  let count=parseInt(likeCountSpan.textContent)||0;
  
  // Optimistic UI update
  const wasLiked=button.classList.contains('liked');
  button.classList.toggle('liked',!wasLiked);
  icon.classList.toggle('bi-hand-thumbs-up',wasLiked);
  icon.classList.toggle('bi-hand-thumbs-fill',!wasLiked);
  likeCountSpan.textContent=wasLiked?count-1:count+1;
  
  // Send AJAX request
  fetch(`/blog/comment/${commentId}/like`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json',
    },
    body: JSON.stringify({ liked: !wasLiked }),
  })
  .then(response => response.json())
  .then(data => {
    if(data.success){
      likeCountSpan.textContent=data.like_count;
      toast('✓ Terima kasih!');
    } else {
      // Revert on error
      button.classList.toggle('liked',wasLiked);
      icon.classList.toggle('bi-hand-thumbs-up',!wasLiked);
      icon.classList.toggle('bi-hand-thumbs-fill',wasLiked);
      likeCountSpan.textContent=wasLiked?count+1:count-1;
      toast('✗ Gagal menyimpan like.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    // Revert on error
    button.classList.toggle('liked',wasLiked);
    icon.classList.toggle('bi-hand-thumbs-up',!wasLiked);
    icon.classList.toggle('bi-hand-thumbs-fill',wasLiked);
    likeCountSpan.textContent=wasLiked?count+1:count-1;
    toast('✗ Terjadi kesalahan.');
  })
  .finally(() => {
    commentLikeProcessing=false;
  });
}

/* ─── SHARE ──────────────────────────────────────── */
function shareWA(){
  const url=encodeURIComponent(window.location.href);
  const title=encodeURIComponent(document.title);
  window.open(`https://wa.me/?text=${title}%20${url}`,'_blank');
}

function shareFB(){
  const url=encodeURIComponent(window.location.href);
  window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`,'_blank');
}

function shareTW(){
  const url=encodeURIComponent(window.location.href);
  const title=encodeURIComponent(document.title);
  window.open(`https://twitter.com/intent/tweet?text=${title}&url=${url}`,'_blank');
}

function copyLink(){
  navigator.clipboard.writeText(window.location.href).then(()=>{
    toast('✓ Link berhasil disalin ke clipboard!');
  }).catch(()=>{
    toast('✗ Gagal menyalin link. Coba manual.');
  });
}

/* ─── COMMENT FORM ───────────────────────────────── */
let commentSubmitting=false;
let selectedParentId=null;
let selectedParentElement=null;

function setReplyTo(commentId, authorName, buttonElement){
  // Set parent ID
  selectedParentId=commentId;
  document.getElementById('parentCommentId').value=commentId;
  
  // Show reply indicator
  const indicator=document.getElementById('replyIndicator');
  const nameEl=document.getElementById('replyingToName');
  nameEl.textContent='@' + authorName;
  indicator.style.display='block';
  
  // Highlight selected comment
  if(selectedParentElement){
    selectedParentElement.style.background='';
    selectedParentElement.style.transition='';
  }
  selectedParentElement=buttonElement.closest('.cm-content').parentElement;
  selectedParentElement.style.background='rgba(46,125,78,.08)';
  selectedParentElement.style.transition='background 0.3s ease';
  
  // Scroll to form
  document.getElementById('commentForm').scrollIntoView({behavior:'smooth',block:'center'});
  document.getElementById('cmText').focus();
}

function cancelReply(){
  // Clear parent ID
  selectedParentId=null;
  document.getElementById('parentCommentId').value='';
  
  // Hide indicator
  document.getElementById('replyIndicator').style.display='none';
  
  // Remove highlight
  if(selectedParentElement){
    selectedParentElement.style.background='';
    selectedParentElement=null;
  }
  
  // Clear form
  document.getElementById('cmText').value='';
  document.getElementById('charCount').textContent='0/2000 characters';
}

function submitComment(event){
  event.preventDefault();
  
  if(commentSubmitting) return; // Prevent double submission
  
  const form=document.getElementById('commentForm');
  const name=document.getElementById('cmName').value.trim();
  const email=document.getElementById('cmEmail').value.trim();
  const text=document.getElementById('cmText').value.trim();
  const submitBtn=document.getElementById('submitBtn');
  
  // Validation
  if(!name){
    document.getElementById('cmName').focus();
    toast('✗ Nama wajib diisi.');
    return;
  }
  if(!email.includes('@')){
    document.getElementById('cmEmail').focus();
    toast('✗ Email tidak valid.');
    return;
  }
  if(!text || text.length < 10){
    document.getElementById('cmText').focus();
    toast('✗ Komentar minimal 10 karakter.');
    return;
  }
  
  commentSubmitting=true;
  submitBtn.disabled=true;
  submitBtn.innerHTML='<i class="bi bi-hourglass-split"></i> Mengirim...';
  
  // Send AJAX request
  fetch('{{ route("blog.comment.submit") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json',
    },
    body: JSON.stringify({
      post_id: form.querySelector('[name="post_id"]').value,
      parent_id: selectedParentId,
      author_name: name,
      author_email: email,
      content: text,
    }),
  })
  .then(response => response.json())
  .then(data => {
    if(data.success){
      // Clear form
      document.getElementById('cmName').value='';
      document.getElementById('cmEmail').value='';
      document.getElementById('cmText').value='';
      document.getElementById('charCount').textContent='0/2000 characters';
      document.getElementById('parentCommentId').value='';
      
      // Remove highlight
      if(selectedParentElement){
        selectedParentElement.style.background='';
        selectedParentElement=null;
      }
      
      // Hide indicator
      document.getElementById('replyIndicator').style.display='none';
      selectedParentId=null;
      
      // Insert comment into DOM
      insertCommentIntoDOM(data.comment);
      
      toast('✓ Komentar berhasil dikirim!');
    } else {
      toast('✗ ' + data.message);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toast('✗ Terjadi kesalahan. Silakan coba lagi.');
  })
  .finally(() => {
    commentSubmitting=false;
    submitBtn.disabled=false;
    submitBtn.innerHTML='<i class="bi bi-send-fill"></i> Kirim Komentar';
  });
}

function insertCommentIntoDOM(comment){
  const newCommentHTML=`
    <div class="comment-item" id="comment-${comment.id}" style="animation:fadeUp 0.7s ease-out;">
      <div class="cm-avatar" style="background:linear-gradient(135deg,#25d366,#0fa855);">${comment.author_name.charAt(0).toUpperCase()}</div>
      <div class="cm-content">
        <div class="cm-head">
          <span class="cm-name">${comment.author_name}</span>
          <span class="cm-date"><i class="bi bi-clock" style="font-size:.65rem;"></i> ${comment.created_at}</span>
          ${comment.is_official ? '<span class="cm-badge official">✦ Official</span>' : ''}
        </div>
        <div class="cm-bubble">${comment.content}</div>
        <div class="cm-actions">
          <form action="/blog/comment/${comment.id}/like" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="cm-action"><i class="bi bi-hand-thumbs-up"></i> ${comment.likes} Suka</button>
          </form>
          <button class="cm-action" onclick="setReplyTo(${comment.id}, '${comment.author_name}', this)"><i class="bi bi-reply"></i> Balas</button>
        </div>
      </div>
    </div>
  `;
  
  if(selectedParentId){
    // This is a reply - find parent comment and check depth
    const parentComment=document.getElementById(`comment-${selectedParentId}`);
    
    if(parentComment){
      // Count depth by traversing up the DOM
      let depth=1;
      let current=parentComment;
      while(current.parentElement){
        if(current.parentElement.classList.contains('comment-reply')){
          depth++;
          current=current.parentElement.previousElementSibling;
        } else {
          break;
        }
      }
      
      // Check if we're at max depth (3 levels)
      if(depth >= 3){
        toast('✗ Maksimal 3 level balasan');
        commentSubmitting=false;
        document.getElementById('submitBtn').disabled=false;
        document.getElementById('submitBtn').innerHTML='<i class="bi bi-send-fill"></i> Kirim Komentar';
        return;
      }
      
      // Find the closest reply section (could be nested)
      let replySection=parentComment.nextElementSibling;
      
      // Check if next element is a reply section
      if(!replySection || !replySection.classList.contains('comment-reply')){
        // Create new reply section after parent
        replySection=document.createElement('div');
        replySection.className='comment-reply';
        parentComment.insertAdjacentElement('afterend', replySection);
      }
      
      // Insert reply into section (hide reply button if at level 3)
      const showReplyButton = (depth + 1) < 3;
      const newCommentHTMLWithDepth=`
        <div class="comment-item" id="comment-${comment.id}" style="animation:fadeUp 0.7s ease-out;">
          <div class="cm-avatar" style="background:linear-gradient(135deg,var(--forest),var(--sage));font-size:.75rem;">${comment.author_name.charAt(0).toUpperCase()}</div>
          <div class="cm-content">
            <div class="cm-head">
              <span class="cm-name">${comment.author_name}</span>
              <span class="cm-date"><i class="bi bi-clock" style="font-size:.65rem;"></i> ${comment.created_at}</span>
              ${comment.is_official ? '<span class="cm-badge official">✦ Official</span>' : ''}
            </div>
            <div class="cm-bubble">${comment.content}</div>
            <div class="cm-actions">
              <button type="button" class="cm-action" onclick="toggleCommentLike(${comment.id}, this)"><i class="bi bi-hand-thumbs-up"></i> <span class="like-count">${comment.likes}</span> Suka</button>
              ${showReplyButton ? `<button class="cm-action" onclick="setReplyTo(${comment.id}, '${comment.author_name}', this)"><i class="bi bi-reply"></i> Balas</button>` : ''}
            </div>
          </div>
        </div>
      `;
      replySection.insertAdjacentHTML('beforeend', newCommentHTMLWithDepth);
      
      // Scroll to new reply
      const newReply=document.getElementById(`comment-${comment.id}`);
      if(newReply){
        newReply.scrollIntoView({behavior:'smooth',block:'nearest'});
      }
    } else {
      // Fallback: add as top-level comment
      const commentList=document.querySelector('.comment-list');
      commentList.insertAdjacentHTML('afterbegin', newCommentHTML);
    }
  } else {
    // This is a new top-level comment
    const commentList=document.querySelector('.comment-list');
    commentList.insertAdjacentHTML('afterbegin', newCommentHTML);
    
    // Scroll to new comment
    const newComment=document.getElementById(`comment-${comment.id}`);
    if(newComment){
      newComment.scrollIntoView({behavior:'smooth',block:'nearest'});
    }
  }
}

// Character counter
document.addEventListener('DOMContentLoaded', function() {
  const commentText=document.getElementById('cmText');
  const charCount=document.getElementById('charCount');
  
  if(commentText && charCount){
    commentText.addEventListener('input', function() {
      const length=this.value.length;
      charCount.textContent=length+'/2000 characters';
      if(length > 2000){
        charCount.style.color='#dc3545';
      } else if(length < 10){
        charCount.style.color='#ffc107';
      } else {
        charCount.style.color='var(--g400)';
      }
    });
  }
});

/* ─── TOAST ──────────────────────────────────────── */
function toast(msg){
  const el=document.getElementById('toast');
  if(!el) return;
  el.textContent=msg;
  el.classList.add('show');
  clearTimeout(el._t);
  el._t=setTimeout(()=>el.classList.remove('show'),3200);
}

/* ─── INIT ───────────────────────────────────────── */
document.addEventListener('DOMContentLoaded',function(){
  initReveal();
  initReadProgress();
  initTOC();
});
</script>
@endpush
