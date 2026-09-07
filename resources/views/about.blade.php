@extends('layouts.app')

@section('title', 'Sobre Nós — IOA Natal | Excelência Internacional em Odontologia')
@section('meta_description', 'Conheça a história, a infraestrutura e o corpo docente de renome do IOA Natal, a maior rede de pós-graduação odontológica premium.')

@section('content')
    <!-- PAGE HERO -->
    <section class="py-20 relative bg-[#0e172a]/80 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Institucional</span>
            <h1 class="text-4xl sm:text-5xl font-serif font-bold text-white">
                {{ $aboutContent->title ?? 'Sobre o IOA Natal' }}
            </h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-base sm:text-lg">
                {{ $aboutContent->subtitle ?? 'Tradição internacional, tecnologia de vanguarda e compromisso inegociável com a alta performance clínica.' }}
            </p>
        </div>
    </section>

    <!-- HISTÓRIA E ESTRUTURA -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <div class="space-y-6">
                    <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Nossa Trajetória</span>
                    <h2 class="text-3xl font-serif font-bold text-white">
                        O Maior Ecossistema de Educação Odontológica das Américas
                    </h2>
                    <div class="prose prose-invert text-slate-300 text-sm sm:text-base space-y-4 leading-relaxed">
                        <p>
                            {{ $aboutContent->content ?? 'O Instituto de Odontologia das Américas (IOA) integra a Dan Robson International Academy, com mais de 50 sedes no Brasil e no exterior. Em Natal, inauguramos um complexo educacional projetado sob os mais rígidos padrões hospitalares e de ergonomia clínica.' }}
                        </p>
                        <p>
                            Nossa proposta pedagógica rompe com o modelo meramente expositivo. Aqui, cada especialista vivencia o diagnóstico 3D por tomografia computadorizada cone beam, planejamento cirúrgico guiado e ampla prática clínica sobre pacientes reais da triagem institucional.
                        </p>
                    </div>

                    <div class="pt-2">
                        <a href="{{ whatsapp_link('Olá! Gostaria de agendar uma visita guiada às instalações do IOA Natal.') }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-xs uppercase tracking-wider font-bold text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all">
                            <span>Agendar Visita às Instalações</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden aspect-[4/3] border border-[#F4BF45]/30 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80" alt="Clínica IOA Natal" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -right-6 p-6 rounded-2xl card-glass border border-[#F4BF45]/40 shadow-2xl max-w-xs hidden sm:block">
                        <div class="text-3xl font-serif font-extrabold text-gold-gradient">24 Equipos</div>
                        <div class="text-xs text-slate-200 mt-1">Clínicas completas com centro cirúrgico e sedação inalatória.</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- MISSÃO, VISÃO E VALORES -->
    <section class="py-20 bg-[#0e172a]/60 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="card-glass p-8 rounded-2xl border-t-4 border-t-[#F4BF45]">
                    <div class="w-12 h-12 rounded-xl bg-gold-gradient flex items-center justify-center text-[#18243d] font-bold mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-white mb-3">Nossa Missão</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $aboutContent->extra_data['missao'] ?? 'Capacitar cirurgiões-dentistas com o que há de mais avançado na ciência e na prática odontológica global, formando líderes clínicos de alta performance.' }}
                    </p>
                </div>

                <div class="card-glass p-8 rounded-2xl border-t-4 border-t-[#F4BF45]">
                    <div class="w-12 h-12 rounded-xl bg-gold-gradient flex items-center justify-center text-[#18243d] font-bold mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-white mb-3">Nossa Visão</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $aboutContent->extra_data['visao'] ?? 'Ser reconhecido como o principal polo de excelência e inovação no ensino odontológico do Nordeste, integrando tecnologia 3D e humanização.' }}
                    </p>
                </div>

                <div class="card-glass p-8 rounded-2xl border-t-4 border-t-[#F4BF45]">
                    <div class="w-12 h-12 rounded-xl bg-gold-gradient flex items-center justify-center text-[#18243d] font-bold mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-white mb-3">Nossos Valores</h3>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $aboutContent->extra_data['valores'] ?? 'Rigor científico inegociável, ética profissional, inovação contínua, paixão pelo ensino e valorização do ser humano.' }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- CORPO DOCENTE / EQUIPE -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Professores e Coordenadores</span>
                <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white">Nosso Corpo Docente</h2>
                <p class="text-slate-300 text-sm">Doutores e mestres com reconhecimento nacional e internacional.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($teamMembers as $member)
                    <div class="card-glass card-glass-hover rounded-2xl overflow-hidden flex flex-col group border border-white/10">
                        <div class="aspect-[3/4] overflow-hidden bg-slate-800 relative">
                            <img src="{{ asset_media($member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0e172a] via-transparent to-transparent opacity-80"></div>
                            @if($member->cro)
                                <div class="absolute bottom-3 left-3 px-2.5 py-1 rounded bg-black/70 text-[11px] font-semibold text-[#FEEAA3] border border-[#F4BF45]/20">
                                    {{ $member->cro }}
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between space-y-3">
                            <div>
                                <h3 class="text-base font-serif font-bold text-white group-hover:text-[#F4BF45] transition-colors leading-snug">
                                    {{ $member->name }}
                                </h3>
                                <p class="text-xs text-[#F4BF45] font-medium mt-1">
                                    {{ $member->role }}
                                </p>
                                <p class="text-xs text-slate-300 mt-3 line-clamp-3 leading-relaxed">
                                    {{ $member->bio }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
