@extends('layouts.app')

@section('title', "{$post->title} — Blog IOA Natal")
@section('meta_description', Str::limit($post->excerpt, 160))

@section('extra_head')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "{{ e($post->title) }}",
  "description": "{{ e(Str::limit($post->excerpt, 200)) }}",
  "author": {
    "@type": "Person",
    "name": "{{ e($post->author) }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "IOA Natal — Instituto de Odontologia das Américas",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo-ioa.svg') }}"
    }
  },
  "url": "{{ url()->current() }}",
  @if($post->image)"image": "{{ asset_media($post->image) }}",@endif
  "datePublished": "{{ $post->published_at ? $post->published_at->toIso8601String() : '' }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "articleSection": "{{ e($post->category) }}",
  "keywords": "{{ e($post->tags) }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  }
}
</script>
@endsection

@section('content')
    <!-- ARTICLE HEADER -->
    <article class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <div class="space-y-4 text-center">
                <div class="flex items-center justify-center gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-[#F4BF45]/15 text-[#F4BF45] border border-[#F4BF45]/30">
                        {{ $post->category }}
                    </span>
                    <span class="text-xs text-slate-400">
                        • {{ $post->estimated_reading_time }} min de leitura
                    </span>
                </div>

                <h1 class="text-3xl sm:text-5xl font-serif font-bold text-white leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center justify-center gap-4 text-xs text-slate-300 pt-2 border-b border-white/10 pb-6">
                    <span>Por <strong class="text-white">{{ $post->author }}</strong></span>
                    <span>•</span>
                    <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }}</span>
                    <span>•</span>
                    <span>{{ $post->views_count }} visualizações</span>
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->image)
                <div class="rounded-3xl overflow-hidden aspect-[16/9] border border-white/10 shadow-2xl bg-slate-800">
                    <img src="{{ asset_media($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Excerpt / Highlight -->
            @if($post->excerpt)
                <div class="p-6 rounded-2xl bg-[#1e2f4f]/50 border-l-4 border-[#F4BF45] text-slate-200 text-base sm:text-lg italic leading-relaxed">
                    {{ $post->excerpt }}
                </div>
            @endif

            <!-- Article Body Content -->
            <div class="card-glass p-8 sm:p-12 rounded-3xl space-y-6 text-slate-200 leading-relaxed text-base sm:text-lg prose prose-invert max-w-none prose-headings:font-serif prose-headings:text-white prose-a:text-[#F4BF45] prose-strong:text-white">
                {!! $post->content !!}
            </div>

            <!-- Tags -->
            @if($post->tags)
                <div class="flex flex-wrap items-center gap-2 pt-4">
                    <span class="text-xs uppercase font-bold text-slate-400 mr-2">Tags:</span>
                    @foreach(explode(',', $post->tags) as $tag)
                        <span class="px-3 py-1 rounded-lg text-xs bg-white/5 border border-white/10 text-slate-300">
                            #{{ trim($tag) }}
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- Share & CTA Banner -->
            <div class="card-glass p-8 rounded-3xl border-[#F4BF45]/30 flex flex-col sm:flex-row items-center justify-between gap-6 my-12">
                <div class="space-y-1 text-center sm:text-left">
                    <h3 class="text-lg font-serif font-bold text-white">Gostou deste conteúdo?</h3>
                    <p class="text-xs text-slate-300">Conheça nossos cursos de especialização e eleve sua carreira clínica.</p>
                </div>
                <a href="{{ whatsapp_link("Olá! Li o artigo '{$post->title}' no blog do IOA Natal e gostaria de mais informações.") }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-[#18243d] bg-gold-gradient shadow-gold-glow hover:scale-105 transition-transform">
                    <span>Falar no WhatsApp</span>
                </a>
            </div>

            <!-- Related Posts -->
            @if($relatedPosts->isNotEmpty())
                <div class="pt-12 border-t border-white/10 space-y-6">
                    <h3 class="text-2xl font-serif font-bold text-white">Artigos Relacionados</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedPosts as $related)
                            <div class="card-glass rounded-2xl overflow-hidden flex flex-col group border border-white/10">
                                <div class="h-36 bg-slate-800 relative overflow-hidden">
                                    <img src="{{ asset_media($related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-4 flex-1 flex flex-col justify-between space-y-2">
                                    <h4 class="text-sm font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                        <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                    </h4>
                                    <a href="{{ route('blog.show', $related->slug) }}" class="text-xs font-bold text-[#F4BF45] hover:text-white">
                                        Ler &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </article>
@endsection
