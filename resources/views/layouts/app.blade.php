<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', setting('seo_meta_title', 'IOA Natal — Instituto de Odontologia das Américas'))</title>
    <meta name="description" content="@yield('meta_description', setting('seo_meta_description', 'Referência Internacional em Pós-Graduação, Especialização e Imersão Odontológica em Natal/RN.'))">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Google Fonts: Cinzel & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('extra_head')
</head>
<body class="bg-[#0c1424] text-slate-100 font-sans antialiased min-h-screen flex flex-col selection:bg-[#F4BF45] selection:text-[#18243d]">

    <!-- Ambient background luxury glow -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-[#18243d] rounded-full blur-[140px] opacity-70"></div>
        <div class="absolute top-[30%] -right-40 w-[600px] h-[600px] bg-[#F4BF45] rounded-full blur-[180px] opacity-10"></div>
        <div class="absolute bottom-[20%] -left-40 w-[600px] h-[600px] bg-[#1b2b48] rounded-full blur-[160px] opacity-40"></div>
    </div>

    <!-- HEADER / NAVIGATION -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }"
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="scrolled ? 'bg-[#0e172a]/95 backdrop-blur-md shadow-2xl border-b border-[#F4BF45]/20 py-3' : 'bg-transparent border-b border-white/5 py-5'"
            class="sticky top-0 z-50 transition-all duration-300">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-ioa.svg') }}" alt="IOA Natal" class="h-10 sm:h-12 w-auto transition-transform duration-300 group-hover:scale-105">
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                    <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-[#F4BF45] font-semibold' : 'text-slate-200 hover:text-[#F4BF45]' }}">Início</a>
                    <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-[#F4BF45] font-semibold' : 'text-slate-200 hover:text-[#F4BF45]' }}">Sobre Nós</a>
                    <a href="{{ route('courses.index') }}" class="px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('courses.*') ? 'text-[#F4BF45] font-semibold' : 'text-slate-200 hover:text-[#F4BF45]' }}">Nossos Cursos</a>
                    <a href="{{ route('turmas.index') }}" class="px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('turmas.*') ? 'text-[#F4BF45] font-semibold' : 'text-slate-200 hover:text-[#F4BF45]' }}">Turmas</a>
                    <a href="{{ route('portfolio.index') }}" class="px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('portfolio.*') ? 'text-[#F4BF45] font-semibold' : 'text-slate-200 hover:text-[#F4BF45]' }}">Portfólio</a>
                    <a href="{{ route('blog.index') }}" class="px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('blog.*') ? 'text-[#F4BF45] font-semibold' : 'text-slate-200 hover:text-[#F4BF45]' }}">Blog</a>
                    <a href="{{ route('contact.index') }}" class="px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('contact.*') ? 'text-[#F4BF45] font-semibold' : 'text-slate-200 hover:text-[#F4BF45]' }}">Contato</a>
                </nav>

                <!-- Action CTA: WhatsApp -->
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs uppercase tracking-wider font-bold text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Fale no WhatsApp</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden items-center gap-2">
                    <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="p-2 text-[#F4BF45] hover:text-white">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="p-2 text-slate-200 hover:text-[#F4BF45] focus:outline-none" aria-label="Abrir Menu">
                        <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             @click.away="mobileMenuOpen = false"
             class="lg:hidden bg-[#0c1424]/98 border-b border-[#F4BF45]/30 px-4 pt-2 pb-6 space-y-1 backdrop-blur-xl"
             style="display: none;">
            
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'text-[#F4BF45] bg-white/5' : 'text-slate-200' }}">Início</a>
            <a href="{{ route('about') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('about') ? 'text-[#F4BF45] bg-white/5' : 'text-slate-200' }}">Sobre Nós</a>
            <a href="{{ route('courses.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('courses.*') ? 'text-[#F4BF45] bg-white/5' : 'text-slate-200' }}">Nossos Cursos</a>
            <a href="{{ route('turmas.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('turmas.*') ? 'text-[#F4BF45] bg-white/5' : 'text-slate-200' }}">Turmas</a>
            <a href="{{ route('portfolio.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('portfolio.*') ? 'text-[#F4BF45] bg-white/5' : 'text-slate-200' }}">Portfólio</a>
            <a href="{{ route('blog.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('blog.*') ? 'text-[#F4BF45] bg-white/5' : 'text-slate-200' }}">Blog</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('contact.*') ? 'text-[#F4BF45] bg-white/5' : 'text-slate-200' }}">Contato</a>
            
            <div class="pt-4 mt-2 border-t border-white/10">
                <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" 
                   class="w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-bold text-[#18243d] bg-gold-gradient shadow-gold-glow">
                    <span>Falar no WhatsApp</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Flash Notifications (Toast) -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
             class="fixed top-24 right-4 z-50 max-w-md bg-[#162238] border border-emerald-500/40 text-emerald-300 p-4 rounded-xl shadow-2xl flex items-start gap-3 backdrop-blur-md">
            <svg class="w-6 h-6 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="flex-1 text-sm font-medium">{{ session('success') }}</div>
            <button @click="show = false" class="text-slate-400 hover:text-white">&times;</button>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main class="flex-grow z-10">
        @yield('content')
    </main>

    <!-- GLOBAL FLOATING WHATSAPP BUTTON -->
    <aside aria-label="Atendimento WhatsApp" class="fixed bottom-6 right-6 z-50 flex items-center group">
        <!-- Tooltip on hover -->
        <span class="hidden sm:inline-block mr-3 px-3 py-1.5 rounded-lg bg-[#0e172a] text-slate-200 text-xs font-semibold shadow-xl border border-[#F4BF45]/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            Dúvidas? Fale conosco!
        </span>
        <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" 
           class="relative flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-[#128C7E] to-[#25D366] text-white shadow-2xl hover:scale-110 transition-transform duration-300 border-2 border-[#F4BF45]/50 group-hover:border-[#F4BF45]">
            <!-- Ping ring -->
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-30"></span>
            
            <svg class="w-7 h-7 sm:w-8 sm:h-8 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
        </a>
    </aside>

    <!-- FOOTER -->
    <footer class="relative z-10 bg-[#070d18] border-t border-[#F4BF45]/20 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 pb-12 border-b border-white/10">
                
                <!-- Col 1: About & Brand -->
                <div class="space-y-4">
                    <img src="{{ asset('images/logo-ioa.svg') }}" alt="IOA Natal" class="h-11 w-auto">
                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ setting('site_tagline', 'Excelência Internacional em Pós-Graduação Odontológica.') }} Integrante da maior rede de ensino odontológico premium das Américas.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        @if(setting('instagram'))
                        <a href="{{ setting('instagram') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white/5 hover:bg-[#F4BF45] text-slate-300 hover:text-[#18243d] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if(setting('facebook'))
                        <a href="{{ setting('facebook') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white/5 hover:bg-[#F4BF45] text-slate-300 hover:text-[#18243d] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.667 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg>
                        </a>
                        @endif
                        @if(setting('youtube'))
                        <a href="{{ setting('youtube') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white/5 hover:bg-[#F4BF45] text-slate-300 hover:text-[#18243d] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h4 class="text-sm font-bold tracking-wider text-[#F4BF45] uppercase mb-4">Navegação</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="{{ route('home') }}" class="hover:text-[#F4BF45] transition-colors">Início</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-[#F4BF45] transition-colors">Sobre o IOA Natal</a></li>
                        <li><a href="{{ route('courses.index') }}" class="hover:text-[#F4BF45] transition-colors">Especializações e Cursos</a></li>
                        <li><a href="{{ route('turmas.index') }}" class="hover:text-[#F4BF45] transition-colors">Próximas Turmas</a></li>
                        <li><a href="{{ route('portfolio.index') }}" class="hover:text-[#F4BF45] transition-colors">Galeria de Instalações</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-[#F4BF45] transition-colors">Artigos & Novidades</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-[#F4BF45] transition-colors">Fale Conosco</a></li>
                    </ul>
                </div>

                <!-- Col 3: Cursos em Destaque -->
                <div>
                    <h4 class="text-sm font-bold tracking-wider text-[#F4BF45] uppercase mb-4">Áreas de Atuação</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="{{ route('courses.index', ['categoria' => 'Especialização']) }}" class="hover:text-[#F4BF45] transition-colors">Implantodontia & Prótese</a></li>
                        <li><a href="{{ route('courses.index', ['categoria' => 'Especialização']) }}" class="hover:text-[#F4BF45] transition-colors">Harmonização Orofacial (HOF)</a></li>
                        <li><a href="{{ route('courses.index', ['categoria' => 'Especialização']) }}" class="hover:text-[#F4BF45] transition-colors">Ortodontia & Alinhadores</a></li>
                        <li><a href="{{ route('courses.index', ['categoria' => 'Especialização']) }}" class="hover:text-[#F4BF45] transition-colors">Endodontia Microscópica</a></li>
                        <li><a href="{{ route('courses.index', ['categoria' => 'Imersão']) }}" class="hover:text-[#F4BF45] transition-colors">Lentes de Contato e Cerâmicas</a></li>
                        <li><a href="{{ route('courses.index', ['categoria' => 'Aperfeiçoamento']) }}" class="hover:text-[#F4BF45] transition-colors">Cirurgia Oral Menor</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact Info -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold tracking-wider text-[#F4BF45] uppercase mb-4">Localização & Contato</h4>
                    <p class="text-sm text-slate-300 flex items-start gap-2.5">
                        <svg class="w-5 h-5 text-[#F4BF45] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ setting('address', 'Av. Gov. Tarcísio de Vasconcelos Maia, 1500 - Candelária, Natal/RN') }}</span>
                    </p>
                    <p class="text-sm text-slate-300 flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#F4BF45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>{{ setting('phone', '(84) 3211-9800') }}</span>
                    </p>
                    <p class="text-sm text-slate-300 flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#F4BF45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>{{ setting('email', 'contato@ioanatal.com.br') }}</span>
                    </p>
                    <p class="text-xs text-slate-400 pt-1">
                        {{ setting('business_hours', 'Segunda a Sexta: 08:00 às 18:30') }}
                    </p>
                </div>

            </div>

            <!-- Bottom disclaimer & copyright -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} IOA Natal — Instituto de Odontologia das Américas. Todos os direitos reservados.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="text-slate-400 hover:text-[#F4BF45] transition-colors">Área Restrita / Painel CMS</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine.js Lightbox Modal Component for Portfolio -->
    <div x-data="{ 
            open: false, 
            src: '', 
            title: '', 
            desc: '',
            init() {
                window.addEventListener('open-lightbox', e => {
                    this.src = e.detail.src;
                    this.title = e.detail.title || '';
                    this.desc = e.detail.desc || '';
                    this.open = true;
                });
            }
         }"
         x-show="open" 
         @keydown.escape.window="open = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="open = false" class="relative max-w-5xl w-full bg-[#162238] rounded-2xl overflow-hidden border border-[#F4BF45]/40 shadow-2xl">
            <button @click="open = false" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/60 text-white hover:text-[#F4BF45] flex items-center justify-center text-2xl font-bold">&times;</button>
            <div class="max-h-[75vh] overflow-hidden flex items-center justify-center bg-black/40">
                <img :src="src" :alt="title" class="w-full max-h-[75vh] object-contain">
            </div>
            <div class="p-6 bg-[#0e1728] border-t border-white/10" x-show="title || desc">
                <h4 x-text="title" class="text-lg font-bold text-[#F4BF45]"></h4>
                <p x-text="desc" class="text-sm text-slate-300 mt-1"></p>
            </div>
        </div>
    </div>

    @yield('extra_scripts')
</body>
</html>
