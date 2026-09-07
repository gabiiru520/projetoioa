@extends('layouts.app')

@section('title', "{$course->title} — IOA Natal")
@section('meta_description', Str::limit($course->summary, 160))

@section('extra_head')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "{{ e($course->title) }}",
  "description": "{{ e(Str::limit($course->summary, 300)) }}",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "IOA Natal — Instituto de Odontologia das Américas",
    "url": "{{ config('app.url') }}",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Natal",
      "addressRegion": "RN",
      "addressCountry": "BR"
    }
  },
  "url": "{{ url()->current() }}",
  @if($course->image)"image": "{{ asset_media($course->image) }}",@endif
  "educationalLevel": "{{ e($course->category) }}",
  "hasCourseInstance": {
    "@type": "CourseInstance",
    "courseMode": "{{ e($course->modality) }}"
    @if($course->duration_workload),"duration": "{{ e($course->duration_workload) }}"@endif
  }
}
</script>
@endsection

@section('content')
    <!-- COURSE HEADER HERO -->
    <section class="py-16 relative bg-[#0e172a]/90 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="space-y-4 max-w-4xl">
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-[#F4BF45]/15 text-[#F4BF45] border border-[#F4BF45]/30">
                        {{ $course->category }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-white/5 text-slate-300 border border-white/10">
                        {{ $course->modality }}
                    </span>
                    @if($course->duration_workload)
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-white/5 text-slate-300 border border-white/10">
                        {{ $course->duration_workload }}
                    </span>
                    @endif
                </div>

                <h1 class="text-3xl sm:text-5xl font-serif font-bold text-white leading-tight">
                    {{ $course->title }}
                </h1>

                @if($course->summary)
                    <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                        {{ $course->summary }}
                    </p>
                @endif
            </div>

        </div>
    </section>

    <!-- MAIN COURSE CONTENT & SIDEBAR -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left Column: Details & Syllabus -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Cover Image -->
                    <div class="rounded-3xl overflow-hidden aspect-[16/9] border border-white/10 shadow-2xl bg-slate-800">
                        <img src="{{ asset_media($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Sobre o Curso / Descrição -->
                    @if($course->description)
                        <div class="card-glass p-8 rounded-2xl space-y-4">
                            <h2 class="text-2xl font-serif font-bold text-white border-b border-white/10 pb-4">
                                Sobre o Curso
                            </h2>
                            <div class="text-slate-200 text-sm sm:text-base leading-relaxed space-y-4">
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Público-Alvo -->
                    @if($course->target_audience)
                        <div class="card-glass p-8 rounded-2xl space-y-4">
                            <h3 class="text-xl font-serif font-bold text-[#F4BF45]">
                                Público-Alvo
                            </h3>
                            <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                                {{ $course->target_audience }}
                            </p>
                        </div>
                    @endif

                    <!-- Conteúdo Programático / Ementa -->
                    @if($course->syllabus)
                        <div class="card-glass p-8 rounded-2xl space-y-6">
                            <h3 class="text-2xl font-serif font-bold text-white border-b border-white/10 pb-4">
                                Conteúdo Programático & Módulos
                            </h3>
                            <div class="text-slate-200 text-sm sm:text-base space-y-3 whitespace-pre-line leading-relaxed font-light">
                                {{ $course->syllabus }}
                            </div>
                        </div>
                    @endif

                    <!-- Turmas deste curso -->
                    @if($course->activeTurmas->isNotEmpty())
                        <div class="card-glass p-8 rounded-2xl space-y-6 border-[#F4BF45]/30">
                            <h3 class="text-2xl font-serif font-bold text-white border-b border-white/10 pb-4">
                                Turmas Confirmadas
                            </h3>
                            <div class="space-y-4">
                                @foreach($course->activeTurmas as $turma)
                                    <div class="p-5 rounded-xl bg-white/5 border border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold uppercase {{ $turma->status_badge_class }}">
                                                    {{ $turma->status }}
                                                </span>
                                                @if($turma->spots)
                                                    <span class="text-xs text-[#F4BF45] font-semibold">{{ $turma->spots }}</span>
                                                @endif
                                            </div>
                                            <div class="text-base font-bold text-white">{{ $turma->title }}</div>
                                            <div class="text-xs text-slate-300">
                                                @if($turma->start_date) Início: {{ $turma->start_date->format('d/m/Y') }} • @endif
                                                {{ $turma->schedule }}
                                            </div>
                                        </div>

                                        <a href="{{ $turma->whatsapp_url }}" target="_blank" rel="noopener noreferrer" 
                                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs uppercase tracking-wider font-bold text-[#18243d] bg-gold-gradient shadow-gold-glow-sm hover:scale-105 transition-transform">
                                            <span>Matricular via WhatsApp</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Right Column: Sidebar Sticky -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="card-glass p-8 rounded-3xl border-[#F4BF45]/40 shadow-2xl sticky top-28 space-y-6">
                        
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#F4BF45]">Investimento & Condições</span>
                            <div class="text-lg font-serif font-bold text-white mt-1">
                                {{ $course->investment ?? 'Consulte condições de matrícula' }}
                            </div>
                        </div>

                        <hr class="border-white/10">

                        <div class="space-y-3 text-xs text-slate-300">
                            @if($course->coordinator)
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Coordenação Científica:</span>
                                    <strong class="text-white text-sm font-serif">{{ $course->coordinator }}</strong>
                                </div>
                            @endif
                            @if($course->duration_workload)
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Duração / Carga Horária:</span>
                                    <span class="text-white">{{ $course->duration_workload }}</span>
                                </div>
                            @endif
                            @if($course->schedule_info)
                                <div>
                                    <span class="text-slate-400 block mb-0.5">Periodicidade:</span>
                                    <span class="text-white">{{ $course->schedule_info }}</span>
                                </div>
                            @endif
                            <div>
                                <span class="text-slate-400 block mb-0.5">Certificação:</span>
                                <span class="text-white">Reconhecido pelo CFO / Rede IOA Internacional</span>
                            </div>
                        </div>

                        <div class="pt-2 space-y-3">
                            <a href="{{ whatsapp_link("Olá! Gostaria de fazer minha pré-matrícula ou tirar dúvidas sobre o curso {$course->title} no IOA Natal.") }}" 
                               target="_blank" rel="noopener noreferrer" 
                               class="w-full inline-flex items-center justify-center gap-3 py-4 rounded-xl font-bold text-sm uppercase tracking-wider text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>Falar no WhatsApp</span>
                            </a>

                            <a href="{{ route('contact.index') }}" 
                               class="w-full inline-flex items-center justify-center py-3 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 transition-colors">
                                <span>Enviar Mensagem</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Related Courses -->
            @if($relatedCourses->isNotEmpty())
                <div class="pt-20 border-t border-white/10 mt-20">
                    <h3 class="text-2xl font-serif font-bold text-white mb-8">Outros Cursos que Podem Lhe Interessar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($relatedCourses as $related)
                            <div class="card-glass card-glass-hover rounded-2xl overflow-hidden flex flex-col group border border-white/10">
                                <div class="h-44 bg-slate-800 relative overflow-hidden">
                                    <img src="{{ asset_media($related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                                    <h4 class="text-base font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                        <a href="{{ route('courses.show', $related->slug) }}">{{ $related->title }}</a>
                                    </h4>
                                    <a href="{{ route('courses.show', $related->slug) }}" class="text-xs uppercase font-bold tracking-wider text-[#F4BF45] hover:text-white">
                                        Ver curso &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
