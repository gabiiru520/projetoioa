@extends('layouts.app')

@section('title', 'Portfólio & Instalações — IOA Natal')
@section('meta_description', 'Explore nossa infraestrutura odontológica premium: clínicas, centros cirúrgicos, laboratório digital 3D e turmas formadas.')

@section('content')
    <!-- PAGE HERO -->
    <section class="py-16 relative bg-[#0e172a]/80 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Galeria & Projetos</span>
            <h1 class="text-4xl sm:text-5xl font-serif font-bold text-white">Portfólio & Instalações</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-base">
                Conheça de perto o ambiente onde a excelência odontológica é construída todos os dias.
            </p>
        </div>
    </section>

    <!-- FILTER BAR -->
    <section class="py-8 bg-[#0c1424]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-center gap-2 pb-4">
                <a href="{{ route('portfolio.index') }}" 
                   class="px-5 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ empty($category) || $category === 'todos' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                    Todos
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('portfolio.index', ['categoria' => $cat]) }}" 
                       class="px-5 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ $category === $cat ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- GALLERY GRID -->
    <section class="py-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($items->isEmpty())
                <div class="card-glass p-12 text-center rounded-2xl max-w-xl mx-auto">
                    <p class="text-slate-300">Nenhum item encontrado nesta categoria.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($items as $item)
                        <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-800 border border-white/10 cursor-pointer shadow-xl"
                             @click="$dispatch('open-lightbox', { src: '{{ asset_media($item->image) }}', title: '{{ addslashes($item->title) }}', desc: '{{ addslashes($item->description) }}' })">
                            
                            <img src="{{ asset_media($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0e172a] via-[#0e172a]/30 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>
                            
                            <div class="absolute inset-0 p-6 flex flex-col justify-between">
                                <div class="flex justify-between items-start">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-black/60 text-[#F4BF45] border border-[#F4BF45]/30 backdrop-blur-sm">
                                        {{ $item->category }}
                                    </span>
                                    <span class="w-9 h-9 rounded-full bg-gold-gradient text-[#18243d] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-gold-glow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                    </span>
                                </div>

                                <div>
                                    <h3 class="text-lg font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                        {{ $item->title }}
                                    </h3>
                                    @if($item->date_label)
                                        <p class="text-xs text-[#FEEAA3] mt-1">{{ $item->date_label }}</p>
                                    @endif
                                    @if($item->description)
                                        <p class="text-xs text-slate-300 mt-2 line-clamp-2">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $items->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
