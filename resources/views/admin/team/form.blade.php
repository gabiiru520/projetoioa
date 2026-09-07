@extends('layouts.admin')

@section('title', $member->exists ? 'Editar Docente' : 'Novo Docente')
@section('header_title', $member->exists ? 'Editar Docente: ' . $member->name : 'Cadastrar Novo Docente')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.team.index') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar para equipe</span>
            </a>
        </div>

        <form action="{{ $member->exists ? route('admin.team.update', $member->id) : route('admin.team.store') }}" 
              method="POST" enctype="multipart/form-data" 
              class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-6 shadow-2xl">
            @csrf
            @if($member->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Name -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="name" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Nome Completo com Titulação *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required placeholder="Ex: Prof. Dr. Marcelo Albuquerque" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('name') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Role -->
                <div class="space-y-1">
                    <label for="role" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Cargo / Especialidade *</label>
                    <input type="text" id="role" name="role" value="{{ old('role', $member->role) }}" required placeholder="Ex: Coordenador de Implantodontia" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- CRO -->
                <div class="space-y-1">
                    <label for="cro" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Número de Registro no CRO</label>
                    <input type="text" id="cro" name="cro" value="{{ old('cro', $member->cro) }}" placeholder="Ex: CRO-RN 4892" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Bio -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="bio" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Mini Currículo / Biografia Resumida</label>
                    <textarea id="bio" name="bio" rows="4" 
                              class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('bio', $member->bio) }}</textarea>
                </div>

                <!-- Photo Upload & URL -->
                <div class="sm:col-span-2 space-y-2 p-5 rounded-2xl bg-white/5 border border-white/10">
                    <label class="text-xs font-semibold text-[#F4BF45] uppercase tracking-wider block">Foto do Docente</label>
                    
                    @if($member->photo)
                        <div class="flex items-center gap-4 py-2">
                            <img src="{{ asset_media($member->photo) }}" class="w-16 h-16 object-cover rounded-full border border-white/20">
                            <span class="text-xs text-slate-400">Foto atual.</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label for="photo" class="text-xs text-slate-300 block mb-1">Upload de Foto:</label>
                            <input type="file" id="photo" name="photo" accept="image/*" 
                                   class="text-xs text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#F4BF45] file:text-[#18243d] hover:file:opacity-90">
                        </div>
                        <div>
                            <label for="photo_url" class="text-xs text-slate-300 block mb-1">Ou URL externa da Foto:</label>
                            <input type="url" id="photo_url" name="photo_url" placeholder="https://..." 
                                   class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                        </div>
                    </div>
                </div>

                <!-- Toggles & Order -->
                <div class="sm:col-span-2 flex flex-wrap items-center gap-8 pt-2">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $member->exists ? $member->is_active : true) ? 'checked' : '' }} 
                               class="rounded bg-[#18243d] border-white/20 text-[#F4BF45] focus:ring-0">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Ativo no Site</span>
                    </label>

                    <div class="flex items-center gap-2">
                        <label for="sort_order" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Ordem:</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" 
                               class="w-20 bg-[#18243d] border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>
                </div>

            </div>

            <div class="pt-6 border-t border-white/10 flex items-center justify-end gap-3">
                <a href="{{ route('admin.team.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                    {{ $member->exists ? 'Salvar Alterações' : 'Cadastrar Docente' }}
                </button>
            </div>

        </form>
    </div>
@endsection
