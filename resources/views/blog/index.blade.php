@extends('layouts.app')

@section('title', 'Blog Odontológico & Artigos Científicos — IOA Natal')
@section('meta_description', 'Artigos clínicos, inovações em implantodontia, HOF, ortodontia e carreira odontológica com os professores do IOA Natal.')

@section('content')
    <!-- PAGE HERO -->
    <section class="py-16 relative bg-[#0e172a]/80 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Conteúdo Científico & Clínico</span>
            <h1 class="text-4xl sm:text-5xl font-serif font-bold text-white">Blog IOA Natal</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-base">
                Fique por dentro das principais novidades técnicas, lançamentos de protocolos e tendências do mercado odontológico.
            </p>
        </div>
    </section>

    <!-- FILTER & SEARCH BAR -->
    <section class="py-8 bg-[#0c1424]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 pb-6 border-b border-white/10">
                
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('blog.index', ['busca' => $search]) }}" 
                       class="px-4 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ empty($category) || $category === 'todos' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                        Todos
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('blog.index', ['categoria' => $cat, 'busca' => $search]) }}" 
                           class="px-4 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ $category === $cat ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('blog.index') }}" method="GET" class="w-full md:w-72 relative">
                    @if($category)
                        <input type="hidden" name="categoria" value="{{ $category }}">
                    @endif
                    <input type="text" name="busca" value="{{ $search }}" placeholder="Buscar artigos..." 
                           class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-2.5 pl-10 text-sm text-white placeholder-slate-400 focus:outline-none focus:border-[#F4BF45]">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>

            </div>
        </div>
    </section>

    <!-- POSTS GRID -->
    <section class="py-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($posts->isEmpty())
                <div class="card-glass p-12 text-center rounded-2xl max-w-xl mx-auto space-y-4">
                    <p class="text-slate-300">Nenhum artigo encontrado com os filtros informados.</p>
                    <a href="{{ route('blog.index') }}" class="inline-block px-5 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] text-xs font-bold uppercase tracking-wider">
                        Ver Todos os Artigos
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="card-glass card-glass-hover rounded-2xl overflow-hidden flex flex-col group border border-white/10">
                            <div class="relative h-52 overflow-hidden bg-slate-800">
                                <img src="{{ asset_media($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-[#18243d]/90 text-[#F4BF45] border border-[#F4BF45]/30">
                                        {{ $post->category }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div>
                                    <div class="text-xs text-slate-400 mb-2 flex items-center justify-between">
                                        <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }}</span>
                                        <span>{{ $post->estimated_reading_time }} min de leitura</span>
                                    </div>
                                    <h3 class="text-lg font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-300 text-xs sm:text-sm mt-3 line-clamp-3 leading-relaxed">
                                        {{ $post->excerpt }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs">
                                    <span class="text-slate-400">Por: <strong class="text-slate-200">{{ $post->author }}</strong></span>
                                    <a href="{{ route('blog.show', $post->slug) }}" class="font-bold uppercase tracking-wider text-[#F4BF45] hover:text-white inline-flex items-center gap-1">
                                        <span>Ler</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
