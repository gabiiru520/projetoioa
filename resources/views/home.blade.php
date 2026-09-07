@extends('layouts.app')

@section('title', setting('seo_meta_title', 'IOA Natal — Instituto de Odontologia das Américas'))
@section('meta_description', setting('seo_meta_description'))

@section('content')
    <!-- HERO SECTION -->
    <section class="relative min-h-[90vh] flex items-center pt-8 pb-20 overflow-hidden">
        <!-- Subtle radial gold glow -->
        <div class="absolute top-1/2 right-1/4 -translate-y-1/2 w-[550px] h-[550px] bg-[#F4BF45]/10 rounded-full blur-[150px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Left text content -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    
                    <!-- Network badge -->
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-[#1e2f4f]/80 border border-[#F4BF45]/40 shadow-gold-glow-sm">
                        <span class="w-2 h-2 rounded-full bg-[#F4BF45] animate-ping"></span>
                        <span class="text-xs sm:text-sm font-semibold uppercase tracking-widest text-[#FEEAA3]">
                            {{ $heroContent->extra_data['badge'] ?? 'Rede Internacional • Mais de 50 unidades no mundo' }}
                        </span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-3xl sm:text-5xl xl:text-6xl font-serif font-extrabold tracking-tight leading-[1.15] text-white">
                        {{ $heroContent->title ?? 'A Mais Alta Performance na Odontologia das Américas' }}
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-base sm:text-xl text-slate-300 font-light leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        {{ $heroContent->subtitle ?? 'Eleve sua prática clínica ao padrão internacional na sede mais moderna de pós-graduação odontológica de Natal/RN.' }}
                    </p>

                    <!-- CTAs -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-bold text-sm uppercase tracking-wider text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Falar com Consultor</span>
                        </a>

                        <a href="{{ route('courses.index') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl font-bold text-sm uppercase tracking-wider text-slate-200 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#F4BF45]/40 transition-all duration-300">
                            <span>Ver Todos os Cursos</span>
                            <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>

                    <!-- Stats Row -->
                    <div class="pt-8 grid grid-cols-3 gap-4 border-t border-white/10 max-w-xl mx-auto lg:mx-0">
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-gold-gradient font-serif">{{ $heroContent->extra_data['stat_students'] ?? '+15.000' }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">{{ $heroContent->extra_data['stat_students_label'] ?? 'Alunos formados' }}</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-gold-gradient font-serif">{{ $heroContent->extra_data['stat_rating'] ?? '99.4%' }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">{{ $heroContent->extra_data['stat_rating_label'] ?? 'Aprovação clínica' }}</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-gold-gradient font-serif">{{ $heroContent->extra_data['stat_clinics'] ?? '100%' }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">{{ $heroContent->extra_data['stat_clinics_label'] ?? 'Prática em pacientes' }}</div>
                        </div>
                    </div>

                </div>

                <!-- Right 3D Visual -->
                <div class="lg:col-span-5 flex items-center justify-center relative">
                    <div class="relative w-72 h-72 sm:w-96 sm:h-96 flex items-center justify-center">
                        
                        <!-- Glowing backdrop ring -->
                        <div class="absolute inset-0 rounded-full border border-[#F4BF45]/20 animate-pulse-gold"></div>
                        <div class="absolute -inset-4 rounded-full border border-[#F4BF45]/10 animate-spin" style="animation-duration: 40s;"></div>
                        
                        <!-- 3D Globe Vector -->
                        <img src="{{ asset('images/globe-3d.svg') }}" alt="Globo IOA 3D" class="w-64 h-64 sm:w-80 sm:h-80 object-contain drop-shadow-[0_20px_40px_rgba(244,191,69,0.35)] animate-float-globe">
                        
                        <!-- Floating Feature Card 1 -->
                        <div class="absolute -bottom-2 -left-4 sm:bottom-4 sm:-left-6 p-4 rounded-2xl card-glass shadow-2xl border border-[#F4BF45]/30 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gold-gradient flex items-center justify-center text-[#18243d] font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-white uppercase tracking-wider">Certificação</div>
                                <div class="text-[11px] text-[#F4BF45]">Padrão Internacional</div>
                            </div>
                        </div>

                        <!-- Floating Feature Card 2 -->
                        <div class="absolute -top-2 -right-4 sm:top-6 sm:-right-4 p-4 rounded-2xl card-glass shadow-2xl border border-[#F4BF45]/30 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#1e2f4f] text-[#F4BF45] border border-[#F4BF45]/40 flex items-center justify-center font-bold">
                                3D
                            </div>
                            <div>
                                <div class="text-xs font-bold text-white uppercase tracking-wider">Fluxo Digital</div>
                                <div class="text-[11px] text-slate-300">Scanner & CAD/CAM</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION: APRESENTAÇÃO INSTITUCIONAL & DIFERENCIAIS -->
    <section class="py-20 relative bg-[#0e172a]/60 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Por que o IOA Natal</span>
                <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white">
                    {{ $aboutSummary->title ?? 'Tradição, Tecnologia e Resultados Clínicos Reais' }}
                </h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ $aboutSummary->content ?? 'O IOA Natal integra a maior rede de pós-graduação odontológica premium da América Latina, proporcionando formação de alto nível com prática cirúrgica e equipamentos de padrão global.' }}
                </p>
            </div>

            <!-- 3 Pillars Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Pilar 1 -->
                <div class="card-glass card-glass-hover p-8 rounded-2xl relative group">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#18243d] to-[#253961] border border-[#F4BF45]/40 flex items-center justify-center text-[#F4BF45] mb-6 shadow-gold-glow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-white mb-3 group-hover:text-[#F4BF45] transition-colors">
                        {{ $aboutSummary->extra_data['pilar_1_title'] ?? 'Corpo Docente de Renome' }}
                    </h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $aboutSummary->extra_data['pilar_1_desc'] ?? 'Doutores, mestres e autores com ampla vivência em consultório e cirurgia complexa.' }}
                    </p>
                </div>

                <!-- Pilar 2 -->
                <div class="card-glass card-glass-hover p-8 rounded-2xl relative group border-[#F4BF45]/40 shadow-gold-glow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-gold-gradient flex items-center justify-center text-[#18243d] mb-6 shadow-gold-glow">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-white mb-3 group-hover:text-[#F4BF45] transition-colors">
                        {{ $aboutSummary->extra_data['pilar_2_title'] ?? 'Prática Cirúrgica Intensa' }}
                    </h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $aboutSummary->extra_data['pilar_2_desc'] ?? 'Atendimento a pacientes reais sob mentoria direta dos coordenadores em clínicas de ponta.' }}
                    </p>
                </div>

                <!-- Pilar 3 -->
                <div class="card-glass card-glass-hover p-8 rounded-2xl relative group">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#18243d] to-[#253961] border border-[#F4BF45]/40 flex items-center justify-center text-[#F4BF45] mb-6 shadow-gold-glow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-white mb-3 group-hover:text-[#F4BF45] transition-colors">
                        {{ $aboutSummary->extra_data['pilar_3_title'] ?? 'Fluxo 100% Digital' }}
                    </h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $aboutSummary->extra_data['pilar_3_desc'] ?? 'Scanners intraorais, softwares CAD/CAM e tomógrafos de alta resolução integrados às aulas.' }}
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- SECTION: CURSOS EM DESTAQUE -->
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14">
                <div class="space-y-3">
                    <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Formação de Excelência</span>
                    <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white">Nossos Principais Cursos</h2>
                    <p class="text-slate-300 text-sm sm:text-base max-w-xl">Pós-graduações e especializações desenhadas para você se tornar autoridade na sua especialidade.</p>
                </div>
                <a href="{{ route('courses.index') }}" class="mt-6 md:mt-0 inline-flex items-center gap-2 text-sm font-bold text-[#F4BF45] hover:text-[#FFF0B3] group">
                    <span>Ver grade completa</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Course Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredCourses as $course)
                    <div class="card-glass card-glass-hover rounded-2xl overflow-hidden flex flex-col group border border-white/10 hover:border-[#F4BF45]/50 transition-all duration-300">
                        <!-- Image Cover -->
                        <div class="relative h-52 overflow-hidden bg-slate-800">
                            <img src="{{ asset_media($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#18243d] via-transparent to-black/30"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 flex gap-2">
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

                            <!-- Bottom details & button -->
                            <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                                <a href="{{ route('courses.show', $course->slug) }}" class="inline-flex items-center gap-1.5 text-xs uppercase font-bold tracking-wider text-[#F4BF45] hover:text-white">
                                    <span>Saiba mais</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>

                                <a href="{{ whatsapp_link("Olá! Gostaria de detalhes sobre o curso: {$course->title} no IOA Natal.") }}" target="_blank" rel="noopener noreferrer" 
                                   class="p-2 rounded-lg bg-[#F4BF45]/10 hover:bg-[#F4BF45] text-[#F4BF45] hover:text-[#18243d] transition-colors" title="Informações no WhatsApp">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- SECTION: PRÓXIMAS TURMAS / INSCRIÇÕES ABERTAS -->
    <section class="py-20 relative bg-[#0e172a]/70 border-y border-[#F4BF45]/15">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div class="space-y-3">
                    <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Calendário Acadêmico</span>
                    <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white">Próximas Turmas Abertas</h2>
                    <p class="text-slate-300 text-sm sm:text-base">Garanta sua vaga antes do encerramento das inscrições.</p>
                </div>
                <a href="{{ route('turmas.index') }}" class="mt-4 md:mt-0 text-sm font-bold text-[#F4BF45] hover:text-[#FFF0B3]">
                    Ver todas as turmas &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($openTurmas as $turma)
                    <div class="card-glass p-6 rounded-2xl border border-white/10 hover:border-[#F4BF45]/40 transition-all flex flex-col justify-between space-y-5">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between gap-2">
                                <span class="px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider {{ $turma->status_badge_class }}">
                                    {{ $turma->status }}
                                </span>
                                @if($turma->spots)
                                    <span class="text-xs text-[#F4BF45] font-semibold">{{ $turma->spots }}</span>
                                @endif
                            </div>

                            <h4 class="text-lg font-serif font-bold text-white leading-snug">
                                {{ $turma->course ? $turma->course->title : $turma->title }}
                            </h4>

                            <div class="space-y-1.5 text-xs text-slate-300 pt-2">
                                @if($turma->start_date)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>Início previsto: <strong class="text-white">{{ $turma->start_date->format('d/m/Y') }}</strong></span>
                                </div>
                                @endif
                                @if($turma->schedule)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>{{ $turma->schedule }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <a href="{{ $turma->whatsapp_url }}" target="_blank" rel="noopener noreferrer"
                           class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl text-xs uppercase tracking-wider font-bold text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow-sm transition-transform active:scale-95">
                            <span>Garantir Vaga</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- SECTION: PRÉVIA DO PORTFÓLIO & ESTRUTURA -->
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div class="space-y-3">
                    <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Infraestrutura de Alto Padrão</span>
                    <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white">Conheça Nossas Instalações</h2>
                    <p class="text-slate-300 text-sm sm:text-base">Centro cirúrgico, clínicas com 24 equipes, tomógrafo 3D e tecnologia internacional.</p>
                </div>
                <a href="{{ route('portfolio.index') }}" class="mt-4 md:mt-0 text-sm font-bold text-[#F4BF45] hover:text-[#FFF0B3]">
                    Ver galeria completa &rarr;
                </a>
            </div>

            <!-- Portfolio Grid with Alpine.js Lightbox Trigger -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($portfolioItems as $item)
                    <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-800 border border-white/10 cursor-pointer shadow-lg"
                         @click="$dispatch('open-lightbox', { src: '{{ asset_media($item->image) }}', title: '{{ addslashes($item->title) }}', desc: '{{ addslashes($item->description) }}' })">
                        
                        <img src="{{ asset_media($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0e172a] via-[#0e172a]/30 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>
                        
                        <div class="absolute inset-0 p-6 flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-black/60 text-[#F4BF45] border border-[#F4BF45]/30 backdrop-blur-sm">
                                    {{ $item->category }}
                                </span>
                                <span class="w-8 h-8 rounded-full bg-[#F4BF45] text-[#18243d] flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                </span>
                            </div>

                            <div>
                                <h4 class="text-base sm:text-lg font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                    {{ $item->title }}
                                </h4>
                                @if($item->date_label)
                                    <p class="text-xs text-slate-300 mt-1">{{ $item->date_label }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- SECTION: DEPOIMENTOS & PROVA SOCIAL -->
    <section class="py-20 relative bg-[#0e172a]/60 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Reconhecimento</span>
                <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white">O que Nossos Alunos Dizem</h2>
                <p class="text-slate-300 text-sm">Depoimentos de cirurgiões-dentistas que transformaram suas carreiras clínicas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="card-glass p-8 rounded-2xl flex flex-col justify-between space-y-6">
                    <p class="text-slate-200 text-sm leading-relaxed italic">
                        "A especialização em Implantodontia do IOA Natal mudou completamente minha segurança no consultório. Operei casos complexos de enxerto e carga imediata desde os primeiros módulos."
                    </p>
                    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                        <div class="w-11 h-11 rounded-full bg-gold-gradient text-[#18243d] font-bold flex items-center justify-center font-serif">
                            DR
                        </div>
                        <div>
                            <div class="text-sm font-bold text-white">Dr. Daniel Ribeiro</div>
                            <div class="text-xs text-[#F4BF45]">Especialista em Implantodontia</div>
                        </div>
                    </div>
                </div>

                <div class="card-glass p-8 rounded-2xl flex flex-col justify-between space-y-6 border-[#F4BF45]/30 shadow-gold-glow-sm">
                    <p class="text-slate-200 text-sm leading-relaxed italic">
                        "A infraestrutura de HOF com mapeamento por ultrassom e a qualidade dos professores internacionais superaram todas as minhas expectativas. O retorno no faturamento da clínica foi imediato."
                    </p>
                    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                        <div class="w-11 h-11 rounded-full bg-gold-gradient text-[#18243d] font-bold flex items-center justify-center font-serif">
                            LA
                        </div>
                        <div>
                            <div class="text-sm font-bold text-white">Dra. Luiza Aragão</div>
                            <div class="text-xs text-[#F4BF45]">Especialista em Harmonização Orofacial</div>
                        </div>
                    </div>
                </div>

                <div class="card-glass p-8 rounded-2xl flex flex-col justify-between space-y-6">
                    <p class="text-slate-200 text-sm leading-relaxed italic">
                        "O fluxo digital e o planejamento com alinhadores do IOA me colocaram anos à frente no mercado ortodôntico do Rio Grande do Norte. A escola entrega excelência em cada detalhe."
                    </p>
                    <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                        <div class="w-11 h-11 rounded-full bg-gold-gradient text-[#18243d] font-bold flex items-center justify-center font-serif">
                            GS
                        </div>
                        <div>
                            <div class="text-sm font-bold text-white">Dr. Gustavo Saldanha</div>
                            <div class="text-xs text-[#F4BF45]">Especialista em Ortodontia</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- SECTION: ÚLTIMOS POSTS DO BLOG -->
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div class="space-y-3">
                    <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Conhecimento & Inovação</span>
                    <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white">Últimos Artigos do Blog</h2>
                    <p class="text-slate-300 text-sm sm:text-base">Fique por dentro das principais novidades científicas e clínicas.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="mt-4 md:mt-0 text-sm font-bold text-[#F4BF45] hover:text-[#FFF0B3]">
                    Acessar o blog completo &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestPosts as $post)
                    <article class="card-glass card-glass-hover rounded-2xl overflow-hidden flex flex-col group border border-white/10">
                        <div class="relative h-48 overflow-hidden bg-slate-800">
                            <img src="{{ asset_media($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-[#18243d]/90 text-[#F4BF45] border border-[#F4BF45]/30">
                                    {{ $post->category }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <div class="text-xs text-slate-400 mb-2">
                                    {{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }} • {{ $post->estimated_reading_time }} min de leitura
                                </div>
                                <h3 class="text-base font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-slate-300 text-xs sm:text-sm mt-2 line-clamp-2">
                                    {{ $post->excerpt }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-white/10">
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-xs font-bold uppercase tracking-wider text-[#F4BF45] hover:text-white inline-flex items-center gap-1">
                                    <span>Ler artigo</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

        </div>
    </section>

    <!-- SECTION: BANNER FINAL DE CONVERSÃO / CTA WHATSAPP -->
    <section class="py-16 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-[#18243d] via-[#1f3152] to-[#18243d] border border-[#F4BF45]/40 p-8 sm:p-14 shadow-2xl">
                
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-[#F4BF45]/15 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl space-y-6 text-center sm:text-left">
                    <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Inicie Sua Jornada</span>
                    <h2 class="text-2xl sm:text-4xl font-serif font-bold text-white leading-tight">
                        Pronto para transformar sua carreira odontológica com o padrão IOA?
                    </h2>
                    <p class="text-slate-200 text-sm sm:text-base leading-relaxed">
                        Fale diretamente com nossa consultoria acadêmica. Tiramos todas as suas dúvidas sobre ementas, condições de pagamento e agendamos sua visita ao nosso centro cirúrgico.
                    </p>

                    <div class="pt-2 flex flex-col sm:flex-row items-center gap-4">
                        <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-bold text-sm uppercase tracking-wider text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Conversar no WhatsApp</span>
                        </a>

                        <a href="{{ route('contact.index') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl font-bold text-sm uppercase tracking-wider text-white hover:text-[#F4BF45] bg-white/10 hover:bg-white/15 transition-colors">
                            <span>Formulário de Contato</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
