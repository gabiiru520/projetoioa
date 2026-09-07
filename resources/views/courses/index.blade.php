@extends('layouts.app')

@section('title', 'Nossos Cursos & Especializações — IOA Natal')
@section('meta_description', 'Confira todos os cursos de Especialização, Imersão e Aperfeiçoamento odontológico em Natal/RN no IOA Natal.')

@section('content')
    <!-- PAGE HERO -->
    <section class="py-16 relative bg-[#0e172a]/80 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Catálogo Acadêmico</span>
            <h1 class="text-4xl sm:text-5xl font-serif font-bold text-white">Nossos Cursos & Especializações</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-base">
                Programas de pós-graduação desenhados para cirurgiões-dentistas que buscam a mais alta rentabilidade e excelência clínica.
            </p>
        </div>
    </section>

    <!-- FILTER & SEARCH BAR -->
    <section class="py-8 bg-[#0c1424]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 pb-6 border-b border-white/10">
                
                <!-- Category Pills -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('courses.index', ['busca' => $search]) }}" 
                       class="px-4 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ empty($category) || $category === 'todos' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        Todos
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('courses.index', ['categoria' => $cat, 'busca' => $search]) }}" 
                           class="px-4 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ $category === $cat ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                <!-- Search Input Form -->
                <form action="{{ route('courses.index') }}" method="GET" class="w-full md:w-72 relative">
                    @if($category)
                        <input type="hidden" name="categoria" value="{{ $category }}">
                    @endif
                    <input type="text" name="busca" value="{{ $search }}" placeholder="Buscar cursos..." 
                           class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-2.5 pl-10 text-sm text-white placeholder-slate-400 focus:outline-none focus:border-[#F4BF45] transition-colors">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>

            </div>
        </div>
    </section>

    <!-- COURSES LISTING GRID -->
    <section class="py-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($courses->isEmpty())
                <div class="card-glass p-12 text-center rounded-2xl max-w-xl mx-auto space-y-4">
                    <p class="text-slate-300">Nenhum curso encontrado com os filtros selecionados.</p>
                    <a href="{{ route('courses.index') }}" class="inline-block px-5 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] text-xs font-bold uppercase tracking-wider">
                        Limpar Filtros
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="card-glass card-glass-hover rounded-2xl overflow-hidden flex flex-col group border border-white/10 hover:border-[#F4BF45]/50 transition-all duration-300">
                            <!-- Image Cover -->
                            <div class="relative h-52 overflow-hidden bg-slate-800">
                                <img src="{{ asset_media($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#18243d] via-transparent to-black/30"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-[#18243d]/90 text-[#F4BF45] border border-[#F4BF45]/30 backdrop-blur-sm">
                                        {{ $course->category }}
                                    </span>
                                </div>

                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-xs text-slate-200">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $course->duration_workload ?? 'Carga horária completa' }}
                                    </span>
                                    <span class="text-[#FEEAA3] font-medium">{{ $course->modality }}</span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div>
                                    <h3 class="text-lg font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                        <a href="{{ route('courses.show', $course->slug) }}">
                                            {{ $course->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-300 text-xs sm:text-sm mt-3 line-clamp-3 leading-relaxed">
                                        {{ $course->summary }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                                    <a href="{{ route('courses.show', $course->slug) }}" class="inline-flex items-center gap-1.5 text-xs uppercase font-bold tracking-wider text-[#F4BF45] hover:text-white">
                                        <span>Saiba mais</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>

                                    <a href="{{ whatsapp_link("Olá! Gostaria de informações sobre o curso: {$course->title} no IOA Natal.") }}" target="_blank" rel="noopener noreferrer" 
                                       class="p-2 rounded-lg bg-[#F4BF45]/10 hover:bg-[#F4BF45] text-[#F4BF45] hover:text-[#18243d] transition-colors" title="Conversar no WhatsApp">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $courses->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
