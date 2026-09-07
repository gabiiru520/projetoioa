@extends('layouts.admin')

@section('title', 'Gestão de Conteúdo de Páginas')
@section('header_title', 'Textos & Seções do Site')

@section('content')
    <div class="space-y-8" x-data="{ activeTab: 'home_hero' }">
        
        <div>
            <h1 class="text-xl font-bold text-white">Conteúdo das Páginas Institucionais</h1>
            <p class="text-xs text-slate-400">Edite os textos, headlines e chamadas estratégicas de cada página do site.</p>
        </div>

        <!-- Section Tabs -->
        <div class="flex flex-wrap gap-2 border-b border-white/10 pb-4">
            <button @click="activeTab = 'home_hero'" :class="activeTab === 'home_hero' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider font-semibold transition-all">
                Home: Hero Principal
            </button>
            <button @click="activeTab = 'home_about'" :class="activeTab === 'home_about' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider font-semibold transition-all">
                Home: Apresentação & Pilares
            </button>
            <button @click="activeTab = 'sobre'" :class="activeTab === 'sobre' ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider font-semibold transition-all">
                Sobre Nós: Missão & Valores
            </button>
        </div>

        <!-- Tab 1: Home Hero -->
        <div x-show="activeTab === 'home_hero'" class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 shadow-2xl space-y-6">
            <h3 class="text-base font-serif font-bold text-[#F4BF45]">Seção Hero da Home</h3>
            
            <form action="{{ route('admin.pages.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="section" value="hero">

                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Badge do Topo</label>
                        <input type="text" name="extra_data[badge]" value="{{ $homeHero->extra_data['badge'] ?? '' }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Headline Principal *</label>
                        <input type="text" name="title" value="{{ $homeHero->title ?? '' }}" required 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Subtítulo Explicativo</label>
                        <textarea name="subtitle" rows="3" 
                                  class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ $homeHero->subtitle ?? '' }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-white/10">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-slate-300 uppercase">Estatística 1 (Número)</label>
                            <input type="text" name="extra_data[stat_students]" value="{{ $homeHero->extra_data['stat_students'] ?? '' }}" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-sm text-white">
                            <input type="text" name="extra_data[stat_students_label]" value="{{ $homeHero->extra_data['stat_students_label'] ?? '' }}" placeholder="Legenda" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300 mt-1">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-slate-300 uppercase">Estatística 2 (Número)</label>
                            <input type="text" name="extra_data[stat_rating]" value="{{ $homeHero->extra_data['stat_rating'] ?? '' }}" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-sm text-white">
                            <input type="text" name="extra_data[stat_rating_label]" value="{{ $homeHero->extra_data['stat_rating_label'] ?? '' }}" placeholder="Legenda" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300 mt-1">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-slate-300 uppercase">Estatística 3 (Número)</label>
                            <input type="text" name="extra_data[stat_clinics]" value="{{ $homeHero->extra_data['stat_clinics'] ?? '' }}" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-sm text-white">
                            <input type="text" name="extra_data[stat_clinics_label]" value="{{ $homeHero->extra_data['stat_clinics_label'] ?? '' }}" placeholder="Legenda" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300 mt-1">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-white/10 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                        Salvar Seção Hero
                    </button>
                </div>
            </form>
        </div>

        <!-- Tab 2: Home About Summary & Pillars -->
        <div x-show="activeTab === 'home_about'" style="display: none;" class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 shadow-2xl space-y-6">
            <h3 class="text-base font-serif font-bold text-[#F4BF45]">Home: Bloco Sobre & 3 Pilares</h3>
            
            <form action="{{ route('admin.pages.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="section" value="about_summary">

                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Título da Seção *</label>
                        <input type="text" name="title" value="{{ $homeAbout->title ?? '' }}" required 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Texto de Apresentação</label>
                        <textarea name="content" rows="4" 
                                  class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ $homeAbout->content ?? '' }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-white/10">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-[#F4BF45] uppercase">Pilar 1</label>
                            <input type="text" name="extra_data[pilar_1_title]" value="{{ $homeAbout->extra_data['pilar_1_title'] ?? '' }}" placeholder="Título" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-sm text-white">
                            <textarea name="extra_data[pilar_1_desc]" rows="2" placeholder="Descrição" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300">{{ $homeAbout->extra_data['pilar_1_desc'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-[#F4BF45] uppercase">Pilar 2</label>
                            <input type="text" name="extra_data[pilar_2_title]" value="{{ $homeAbout->extra_data['pilar_2_title'] ?? '' }}" placeholder="Título" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-sm text-white">
                            <textarea name="extra_data[pilar_2_desc]" rows="2" placeholder="Descrição" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300">{{ $homeAbout->extra_data['pilar_2_desc'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-[#F4BF45] uppercase">Pilar 3</label>
                            <input type="text" name="extra_data[pilar_3_title]" value="{{ $homeAbout->extra_data['pilar_3_title'] ?? '' }}" placeholder="Título" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-sm text-white">
                            <textarea name="extra_data[pilar_3_desc]" rows="2" placeholder="Descrição" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300">{{ $homeAbout->extra_data['pilar_3_desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-white/10 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                        Salvar Apresentação
                    </button>
                </div>
            </form>
        </div>

        <!-- Tab 3: Sobre Nós -->
        <div x-show="activeTab === 'sobre'" style="display: none;" class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 shadow-2xl space-y-6">
            <h3 class="text-base font-serif font-bold text-[#F4BF45]">Página Sobre Nós: Missão, Visão e Valores</h3>
            
            <form action="{{ route('admin.pages.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="page" value="sobre">
                <input type="hidden" name="section" value="institucional">

                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Título Principal *</label>
                        <input type="text" name="title" value="{{ $sobreInstitucional->title ?? '' }}" required 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Subtítulo</label>
                        <input type="text" name="subtitle" value="{{ $sobreInstitucional->subtitle ?? '' }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">História & Descrição</label>
                        <textarea name="content" rows="4" 
                                  class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ $sobreInstitucional->content ?? '' }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-white/10">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-[#F4BF45] uppercase">Missão</label>
                            <textarea name="extra_data[missao]" rows="3" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300">{{ $sobreInstitucional->extra_data['missao'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-[#F4BF45] uppercase">Visão</label>
                            <textarea name="extra_data[visao]" rows="3" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300">{{ $sobreInstitucional->extra_data['visao'] ?? '' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-[#F4BF45] uppercase">Valores</label>
                            <textarea name="extra_data[valores]" rows="3" class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300">{{ $sobreInstitucional->extra_data['valores'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-white/10 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                        Salvar Sobre Nós
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
