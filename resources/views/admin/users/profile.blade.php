@extends('layouts.admin')

@section('title', 'Meu Perfil')
@section('header_title', 'Configurações da Conta')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6">
        
        <div>
            <h1 class="text-xl font-bold text-white">Meu Perfil</h1>
            <p class="text-xs text-slate-400">Atualize seus dados pessoais e altere sua senha de acesso.</p>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" 
              class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-6 shadow-2xl">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div class="space-y-1">
                    <label for="name" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Nome Completo *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('name') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1">
                    <label for="email" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">E-mail *</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('email') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 border-t border-white/10 space-y-3">
                    <span class="text-xs font-bold text-[#F4BF45] uppercase tracking-wider block">Alteração de Senha</span>
                    
                    <div class="space-y-1">
                        <label for="current_password" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Senha Atual</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        @error('current_password') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label for="new_password" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Nova Senha</label>
                            <input type="password" id="new_password" name="new_password" minlength="6" 
                                   class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                            @error('new_password') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="new_password_confirmation" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Confirmar Nova Senha</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                   class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                    Salvar Perfil
                </button>
            </div>

        </form>
    </div>
@endsection
