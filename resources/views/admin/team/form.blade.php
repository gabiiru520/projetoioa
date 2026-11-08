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
                <div class="sm:col-span-2 space-y-3 p-5 rounded-2xl bg-white/5 border border-white/10"
                     x-data="{ previewUrl: null, fileName: '', fileSize: '', isOversized: false }">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-semibold text-[#F4BF45] uppercase tracking-wider block">Foto do Docente</label>
                        <span class="text-[11px] text-slate-400">Máx: 20 MB (JPG, PNG, WEBP, GIF, SVG)</span>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-6 py-2">
                        @if($member->photo)
                            <div class="space-y-1.5">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Foto Atual</span>
                                <img src="{{ asset_media($member->photo) }}" class="w-20 h-20 object-cover rounded-full border border-white/20 shadow-md">
                            </div>
                        @endif

                        <template x-if="previewUrl">
                            <div class="space-y-1.5">
                                <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Nova Foto Selecionada
                                </span>
                                <div class="flex items-center gap-3">
                                    <img :src="previewUrl" class="w-20 h-20 object-cover rounded-full border-2 border-emerald-500/50 shadow-md">
                                    <div class="space-y-1">
                                        <p class="text-xs text-white font-medium truncate max-w-[200px]" x-text="fileName"></p>
                                        <p class="text-[11px] text-slate-400" x-text="fileSize"></p>
                                        <button type="button" @click="previewUrl = null; fileName = ''; fileSize = ''; isOversized = false; $refs.photoInput.value = ''" 
                                                class="text-xs text-rose-400 hover:text-rose-300 underline block cursor-pointer">
                                            Cancelar seleção
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="isOversized" class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <span>A imagem escolhida tem <strong x-text="fileSize"></strong> e excede o limite recomendado de 20 MB. O envio pode falhar.</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label for="photo" class="text-xs text-slate-300 block mb-1">Upload de Foto:</label>
                            <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml,image/avif,image/heic,image/*" 
                                   x-ref="photoInput"
                                   @change="
                                       const f = $event.target.files[0];
                                       if (f) {
                                           previewUrl = URL.createObjectURL(f);
                                           fileName = f.name;
                                           fileSize = (f.size / (1024 * 1024)).toFixed(2) + ' MB';
                                           isOversized = f.size > 20 * 1024 * 1024;
                                       } else {
                                           previewUrl = null;
                                           fileName = '';
                                           fileSize = '';
                                           isOversized = false;
                                       }
                                   "
                                   class="text-xs text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#F4BF45] file:text-[#18243d] hover:file:opacity-90">
                            @error('photo') <span class="text-xs text-rose-400 block mt-1.5 font-medium">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="photo_url" class="text-xs text-slate-300 block mb-1">Ou URL externa da Foto:</label>
                            <input type="url" id="photo_url" name="photo_url" value="{{ old('photo_url') }}" placeholder="https://..." 
                                   class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                            @error('photo_url') <span class="text-xs text-rose-400 block mt-1.5 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Courses -->
                <div class="sm:col-span-2 space-y-2">
                    <label class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Cursos em que leciona</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 bg-[#18243d] border border-white/10 rounded-xl p-4 max-h-64 overflow-y-auto">
                        @forelse($courses as $course)
                            <label class="flex items-center gap-2 text-sm text-slate-200 cursor-pointer hover:text-white">
                                <input type="checkbox" name="courses[]" value="{{ $course->id }}"
                                    {{ in_array($course->id, old('courses', $member->courses->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="rounded border-white/20 bg-[#131d2e] text-[#F4BF45] focus:ring-[#F4BF45]">
                                <span>{{ $course->title }}</span>
                            </label>
                        @empty
                            <p class="text-xs text-slate-400 sm:col-span-2">Nenhum curso ativo disponível.</p>
                        @endforelse
                    </div>
                    <p class="text-[11px] text-slate-400">Selecione os cursos aos quais este docente estará vinculado e exibido na página pública.</p>
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
