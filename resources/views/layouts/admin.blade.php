<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel CMS') — IOA Natal</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('extra_head')
</head>
<body class="bg-[#0b1320] text-slate-100 font-sans antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-[#070e1a] border-r border-[#F4BF45]/20 flex flex-col justify-between transition-transform duration-300 ease-in-out shrink-0">
        
        <!-- Top brand logo -->
        <div>
            <div class="h-20 flex items-center px-6 border-b border-white/10 gap-3">
                <img src="{{ asset('images/globe-3d.svg') }}" alt="Globo IOA" class="w-8 h-8 object-contain">
                <div>
                    <span class="font-serif font-bold text-base text-[#F4BF45] tracking-wider block leading-tight">IOA NATAL</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest block">Painel Administrativo</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="px-4 py-6 space-y-1.5 text-sm">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">Gestão de Ensino</div>

                <a href="{{ route('admin.courses.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.courses.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <span>Cursos</span>
                </a>

                <a href="{{ route('admin.turmas.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.turmas.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Turmas</span>
                </a>

                <a href="{{ route('admin.team.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.team.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Corpo Docente</span>
                </a>

                <div class="pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">Conteúdo & Mídia</div>

                <a href="{{ route('admin.portfolio.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.portfolio.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Portfólio / Galeria</span>
                </a>

                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.posts.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <span>Blog</span>
                </a>

                <a href="{{ route('admin.pages.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.pages.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Textos das Páginas</span>
                </a>

                <div class="pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">Relacionamento & Sistema</div>

                <a href="{{ route('admin.messages.index') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Mensagens / Leads</span>
                    </div>
                </a>

                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>Configurações</span>
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-[#F4BF45] text-[#18243d] font-bold shadow-gold-glow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span>Usuários Admin</span>
                </a>
            </nav>
        </div>

        <!-- Bottom: Public Link -->
        <div class="p-4 border-t border-white/10">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs text-slate-300 hover:text-[#F4BF45] hover:bg-white/5 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                <span>Visualizar Site Público</span>
            </a>
        </div>
    </aside>

    <!-- CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Top Bar -->
        <header class="h-20 bg-[#070e1a]/80 border-b border-white/10 px-4 sm:px-8 flex items-center justify-between backdrop-blur-md sticky top-0 z-30">
            
            <div class="flex items-center gap-4">
                <!-- Mobile toggle -->
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-slate-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h2 class="text-lg font-bold text-white hidden sm:block">@yield('header_title', 'Painel de Gestão')</h2>
            </div>

            <!-- Profile & Logout Dropdown -->
            <div class="flex items-center gap-4" x-data="{ dropdownOpen: false }">
                <div class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 p-1.5 rounded-full hover:bg-white/5 transition-colors">
                        <div class="w-9 h-9 rounded-full bg-gold-gradient text-[#18243d] font-bold flex items-center justify-center text-sm shadow-gold-glow-sm">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="text-left hidden md:block">
                            <span class="text-xs font-bold text-white block">{{ Auth::user()->name ?? 'Admin' }}</span>
                            <span class="text-[10px] text-slate-400 block">{{ Auth::user()->email ?? '' }}</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                         class="absolute right-0 mt-2 w-48 bg-[#162238] border border-white/10 rounded-2xl shadow-2xl py-2 z-50 text-xs"
                         style="display: none;">
                        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-slate-200 hover:bg-white/10 hover:text-[#F4BF45]">Meu Perfil / Senha</a>
                        <a href="{{ route('home') }}" target="_blank" class="block px-4 py-2 text-slate-200 hover:bg-white/10 hover:text-[#F4BF45]">Ver Site</a>
                        <hr class="border-white/10 my-1">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-rose-400 hover:bg-white/10">Sair do Sistema</button>
                        </form>
                    </div>
                </div>
            </div>

        </header>

        <!-- Main Body Area -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-8 space-y-6">
            
            <!-- Flash Notifications -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

    </div>

    @yield('extra_scripts')
</body>
</html>
