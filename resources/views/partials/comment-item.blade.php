@props(['comment', 'isReply' => false, 'depth' => 1])

<div class="comment-item" id="comment-{{ $comment->id }}">
  <div class="cm-avatar" style="background:{{ $isReply ? 'linear-gradient(135deg,var(--forest),var(--sage))' : 'linear-gradient(135deg,#25d366,#0fa855)' }};{{ $isReply ? 'font-size:.75rem;' : '' }}">
    @if($comment->is_official && $isReply)
      <i class="bi bi-droplet-fill"></i>
    @else
      {{ substr($comment->author_name, 0, 1) }}
    @endif
  </div>
  <div class="cm-content">
    <div class="cm-head">
      <span class="cm-name">{{ $comment->author_name }}</span>
      <span class="cm-date"><i class="bi bi-clock" style="font-size:.65rem;"></i> {{ $comment->created_at->diffForHumans() }}</span>
      @if($comment->is_verified)
      <span class="cm-badge verified">✓ Terverifikasi</span>
      @endif
      @if($comment->is_official)
      <span class="cm-badge official">✦ Official</span>
      @endif
    </div>
    <div class="cm-bubble {{ $comment->is_official ? 'official-bubble' : '' }}">{{ $comment->content }}</div>
    <div class="cm-actions">
      <button type="button" class="cm-action" onclick="toggleCommentLike({{ $comment->id }}, this)"><i class="bi bi-hand-thumbs-up"></i> <span class="like-count">{{ $comment->likes }}</span> Suka</button>
      @if($depth < 3)
      <button class="cm-action" onclick="setReplyTo({{ $comment->id }}, '{{ $comment->author_name }}', this)"><i class="bi bi-reply"></i> Balas</button>
      @endif
    </div>
  </div>
</div>

@if($comment->replies && $comment->replies->count() > 0 && $depth < 3)
<div class="comment-reply">
  @foreach($comment->replies as $reply)
    @include('partials.comment-item', ['comment' => $reply, 'isReply' => true, 'depth' => $depth + 1])
  @endforeach
</div>
@elseif($comment->replies && $comment->replies->count() > 0 && $depth >= 3)
<div class="comment-reply" style="margin-left:28px;padding-left:14px;">
  <div style="font-size:0.75rem;color:var(--g400);font-style:italic;padding:8px 0;">
    <i class="bi bi-chat-left-text"></i> {{ $comment->replies->count() }} balasan lainnya (maksimal 3 level)
  </div>
</div>
@endif
