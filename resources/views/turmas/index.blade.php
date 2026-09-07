@extends('layouts.app')

@section('title', 'Turmas & Calendário Acadêmico — IOA Natal')
@section('meta_description', 'Confira as turmas abertas, datas de início, horários e garanta sua vaga nas especializações do IOA Natal.')

@section('content')
    <!-- PAGE HERO -->
    <section class="py-16 relative bg-[#0e172a]/80 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Calendário Acadêmico</span>
            <h1 class="text-4xl sm:text-5xl font-serif font-bold text-white">Turmas & Inscrições Abertas</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-base">
                Planeje sua pós-graduação. Turmas com número estrito de alunos por clínica para garantir atendimento individualizado.
            </p>
        </div>
    </section>

    <!-- FILTER BAR -->
    <section class="py-8 bg-[#0c1424]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('turmas.index') }}" method="GET" class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-6 border-b border-white/10">
                
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('turmas.index', ['curso' => $courseId]) }}" 
                       class="px-4 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ empty($status) || $status === 'todos' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                        Todas as Turmas
                    </a>
                    <a href="{{ route('turmas.index', ['status' => 'Inscrições abertas', 'curso' => $courseId]) }}" 
                       class="px-4 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ $status === 'Inscrições abertas' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                        Inscrições Abertas
                    </a>
                    <a href="{{ route('turmas.index', ['status' => 'Últimas vagas', 'curso' => $courseId]) }}" 
                       class="px-4 py-2 rounded-full text-xs uppercase tracking-wider font-semibold transition-all {{ $status === 'Últimas vagas' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                        Últimas Vagas
                    </a>
                </div>

                <!-- Course Dropdown Filter -->
                <div class="w-full sm:w-72">
                    @if($status)
                        <input type="hidden" name="status" value="{{ $status }}">
                    @endif
                    <select name="curso" onchange="this.form.submit()" 
                            class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        <option value="">Todos os Cursos</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ $courseId == $c->id ? 'selected' : '' }}>
                                {{ $c->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>
    </section>

    <!-- TURMAS GRID -->
    <section class="py-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($turmas->isEmpty())
                <div class="card-glass p-12 text-center rounded-2xl max-w-xl mx-auto space-y-4">
                    <p class="text-slate-300">Nenhuma turma encontrada com os filtros selecionados.</p>
                    <a href="{{ route('turmas.index') }}" class="inline-block px-5 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] text-xs font-bold uppercase tracking-wider">
                        Ver todas as turmas
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($turmas as $turma)
                        <div class="card-glass card-glass-hover p-8 rounded-2xl border border-white/10 hover:border-[#F4BF45]/40 flex flex-col justify-between space-y-6">
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ $turma->status_badge_class }}">
                                        {{ $turma->status }}
                                    </span>
                                    @if($turma->spots)
                                        <span class="text-xs text-[#F4BF45] font-semibold">{{ $turma->spots }}</span>
                                    @endif
                                </div>

                                <div>
                                    <span class="text-xs font-semibold text-[#FEEAA3] uppercase tracking-wider block mb-1">
                                        {{ $turma->course ? $turma->course->category : 'Curso' }}
                                    </span>
                                    <h3 class="text-xl font-serif font-bold text-white leading-snug">
                                        @if($turma->course)
                                            <a href="{{ route('courses.show', $turma->course->slug) }}" class="hover:text-[#F4BF45] transition-colors">
                                                {{ $turma->course->title }}
                                            </a>
                                        @else
                                            {{ $turma->title }}
                                        @endif
                                    </h3>
                                    <p class="text-xs text-slate-400 mt-1">Identificação: {{ $turma->title }}</p>
                                </div>

                                <div class="space-y-2 pt-3 border-t border-white/10 text-xs text-slate-300">
                                    @if($turma->start_date)
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span>Previsão de Início: <strong class="text-white">{{ $turma->start_date->format('d/m/Y') }}</strong></span>
                                        </div>
                                    @endif
                                    @if($turma->schedule)
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span>{{ $turma->schedule }}</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-2.5">
                                        <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        <span>Modalidade: {{ $turma->modality }} • Sede Natal/RN</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 pt-2">
                                <a href="{{ $turma->whatsapp_url }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-full inline-flex items-center justify-center gap-2.5 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    <span>Garantir Vaga no WhatsApp</span>
                                </a>
                                @if($turma->course)
                                    <a href="{{ route('courses.show', $turma->course->slug) }}" 
                                       class="w-full text-center block text-xs font-semibold text-slate-400 hover:text-white py-1 transition-colors">
                                        Ver programa do curso &rarr;
                                    </a>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $turmas->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
