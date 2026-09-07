@extends('layouts.admin')

@section('title', $user->exists ? 'Editar Usuário' : 'Novo Usuário')
@section('header_title', $user->exists ? 'Editar Usuário: ' . $user->name : 'Cadastrar Novo Administrador')

@section('content')
    <div class="max-w-2xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar para lista de usuários</span>
            </a>
        </div>

        <form action="{{ $user->exists ? route('admin.users.update', $user->id) : route('admin.users.store') }}" 
              method="POST" 
              class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-6 shadow-2xl">
            @csrf
            @if($user->exists)
                @method('PUT')
            @endif

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

                <div class="space-y-1">
                    <label for="role" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Nível de Permissão *</label>
                    <select id="role" name="role" required 
                            class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrador Geral (Total Acesso)</option>
                        <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor de Conteúdo</option>
                    </select>
                </div>

                <div class="space-y-1 pt-2">
                    <label for="password" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">
                        {{ $user->exists ? 'Nova Senha (deixe em branco para manter a atual)' : 'Senha de Acesso *' }}
                    </label>
                    <input type="password" id="password" name="password" {{ $user->exists ? '' : 'required' }} minlength="6" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('password') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1">
                    <label for="password_confirmation" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Confirme a Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" {{ $user->exists ? '' : 'required' }} 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                    {{ $user->exists ? 'Salvar Alterações' : 'Criar Administrador' }}
                </button>
            </div>

        </form>
    </div>
@endsection
