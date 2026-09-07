<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Administrativo — IOA Natal</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a101d] text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Glow -->
    <div class="absolute w-[600px] h-[600px] bg-[#18243d] rounded-full blur-[160px] pointer-events-none -top-40 -left-40"></div>
    <div class="absolute w-[400px] h-[400px] bg-[#F4BF45]/10 rounded-full blur-[140px] pointer-events-none -bottom-20 -right-20"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Brand Header -->
        <div class="text-center mb-8 space-y-3">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('images/logo-ioa.svg') }}" alt="IOA Natal" class="h-12 w-auto mx-auto">
            </a>
            <h1 class="text-xl font-bold text-white pt-2">Painel de Gestão de Conteúdo (CMS)</h1>
            <p class="text-xs text-slate-400">Insira suas credenciais de administrador para acessar.</p>
        </div>

        <!-- Login Card -->
        <div class="card-glass p-8 rounded-3xl border border-[#F4BF45]/30 shadow-2xl space-y-6">
            
            @if(session('info'))
                <div class="p-3 rounded-xl bg-blue-500/10 border border-blue-500/30 text-blue-300 text-xs">
                    {{ session('info') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">E-mail de Acesso</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus 
                           class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45] transition-colors" 
                           placeholder="admin@ioanatal.com.br">
                    @error('email') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1">
                    <label for="password" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Senha</label>
                    <input type="password" id="password" name="password" required 
                           class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45] transition-colors" 
                           placeholder="••••••••">
                    @error('password') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400 pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-[#18243d] border-white/20 text-[#F4BF45] focus:ring-0">
                        <span>Lembrar de mim</span>
                    </label>
                    <span class="text-[11px] text-slate-500">Credencial padrão: admin@ioanatal.com.br</span>
                </div>

                <button type="submit" 
                        class="w-full py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all duration-300">
                    Entrar no Painel
                </button>
            </form>

        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] transition-colors inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar ao site público</span>
            </a>
        </div>

    </div>

</body>
</html>
