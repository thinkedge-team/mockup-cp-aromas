<div class="prose-preview" style="max-height: 600px; overflow-y: auto; padding: 20px; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px;">
    @if($content)
        {!! $content !!}
    @else
        <p style="color: #9ca3af; font-style: italic;">No content to preview. Start writing your article...</p>
    @endif
</div>

<style>
    .prose-preview {
        font-family: 'DM Sans', system-ui, sans-serif;
        font-size: 0.95rem;
        line-height: 1.75;
        color: #374151;
    }
    
    .prose-preview h2 {
        font-family: 'DM Serif Display', Georgia, serif;
        font-size: 1.5rem;
        color: #0F1A12;
        margin: 2.5rem 0 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #E5E7EB;
    }
    
    .prose-preview h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0B2A1A;
        margin: 1.75rem 0 0.75rem;
    }
    
    .prose-preview h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #0B2A1A;
        margin: 1.25rem 0 0.5rem;
    }
    
    .prose-preview p {
        margin-bottom: 1.25rem;
    }
    
    .prose-preview strong {
        color: #1F2937;
        font-weight: 700;
    }
    
    .prose-preview a {
        color: #2E7D4E;
        text-decoration: underline;
    }
    
    .prose-preview blockquote {
        border-left: 4px solid #2E7D4E;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #6B7280;
    }
    
    .prose-preview ul,
    .prose-preview ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
    }
    
    .prose-preview li {
        margin-bottom: 0.5rem;
    }
    
    .prose-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    
    .prose-preview code {
        background: #F3F4F6;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-family: monospace;
        font-size: 0.875rem;
    }
    
    .prose-preview pre {
        background: #1F2937;
        color: #F9FAFB;
        padding: 1rem;
        border-radius: 8px;
        overflow-x: auto;
        margin: 1.5rem 0;
    }
</style>
