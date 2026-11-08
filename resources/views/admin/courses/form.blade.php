@extends('layouts.admin')

@section('title', $course->exists ? 'Editar Curso' : 'Novo Curso')
@section('header_title', $course->exists ? 'Editar Curso: ' . $course->title : 'Cadastrar Novo Curso')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.courses.index') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar para listagem</span>
            </a>
        </div>

        <form action="{{ $course->exists ? route('admin.courses.update', $course->id) : route('admin.courses.store') }}" 
              method="POST" enctype="multipart/form-data" 
              class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-6 shadow-2xl">
            @csrf
            @if($course->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="title" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Título do Curso *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('title') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Slug -->
                <div class="space-y-1">
                    <label for="slug" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Slug da URL (opcional)</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $course->slug) }}" placeholder="deixe vazio para gerar automaticamente" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('slug') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div class="space-y-1">
                    <label for="category" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Categoria *</label>
                    <select id="category" name="category" required 
                            class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        @foreach(['Especialização', 'Imersão', 'Aperfeiçoamento', 'Atualização', 'Master'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $course->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Modality -->
                <div class="space-y-1">
                    <label for="modality" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Modalidade *</label>
                    <input type="text" id="modality" name="modality" value="{{ old('modality', $course->modality ?? 'Presencial') }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Workload -->
                <div class="space-y-1">
                    <label for="duration_workload" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Carga Horária / Duração</label>
                    <input type="text" id="duration_workload" name="duration_workload" value="{{ old('duration_workload', $course->duration_workload) }}" placeholder="Ex: 850 horas • 24 módulos" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Schedule Info -->
                <div class="space-y-1">
                    <label for="schedule_info" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Periodicidade / Dias</label>
                    <input type="text" id="schedule_info" name="schedule_info" value="{{ old('schedule_info', $course->schedule_info) }}" placeholder="Ex: Quinta a Sábado (mensal)" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Coordinator -->
                <div class="space-y-1">
                    <label for="coordinator" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Coordenador do Curso</label>
                    <input type="text" id="coordinator" name="coordinator" value="{{ old('coordinator', $course->coordinator) }}" placeholder="Ex: Prof. Dr. Marcelo Albuquerque" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Investment -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="investment" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Investimento / Condições</label>
                    <input type="text" id="investment" name="investment" value="{{ old('investment', $course->investment) }}" placeholder="Ex: Consulte condições especiais de pré-matrícula" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Summary -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="summary" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Resumo Curto (para cards da vitrine)</label>
                    <textarea id="summary" name="summary" rows="2" 
                              class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('summary', $course->summary) }}</textarea>
                </div>

                <!-- Description -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="description" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Descrição Completa</label>
                    <textarea id="description" name="description" rows="5" 
                              class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('description', $course->description) }}</textarea>
                </div>

                <!-- Target Audience -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="target_audience" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Público-Alvo</label>
                    <input type="text" id="target_audience" name="target_audience" value="{{ old('target_audience', $course->target_audience) }}" placeholder="Ex: Cirurgiões-dentistas graduados e inscritos no CRO" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Syllabus -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="syllabus" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Conteúdo Programático / Ementa (um módulo por linha)</label>
                    <textarea id="syllabus" name="syllabus" rows="7" 
                              class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('syllabus', $course->syllabus) }}</textarea>
                </div>

                <!-- Image Upload & URL -->
                <div class="sm:col-span-2 space-y-3 p-5 rounded-2xl bg-white/5 border border-white/10"
                     x-data="{ previewUrl: null, fileName: '', fileSize: '', isOversized: false }">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-semibold text-[#F4BF45] uppercase tracking-wider block">Imagem de Capa do Curso</label>
                        <span class="text-[11px] text-slate-400">Máx: 20 MB (JPG, PNG, WEBP, GIF, SVG)</span>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-6 py-2">
                        @if($course->image)
                            <div class="space-y-1.5">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Capa Atual</span>
                                <img src="{{ asset_media($course->image) }}" class="w-32 h-20 object-cover rounded-xl border border-white/20 shadow-md">
                            </div>
                        @endif

                        <template x-if="previewUrl">
                            <div class="space-y-1.5">
                                <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Nova Capa Selecionada
                                </span>
                                <div class="flex items-center gap-3">
                                    <img :src="previewUrl" class="w-32 h-20 object-cover rounded-xl border-2 border-emerald-500/50 shadow-md">
                                    <div class="space-y-1">
                                        <p class="text-xs text-white font-medium truncate max-w-[200px]" x-text="fileName"></p>
                                        <p class="text-[11px] text-slate-400" x-text="fileSize"></p>
                                        <button type="button" @click="previewUrl = null; fileName = ''; fileSize = ''; isOversized = false; $refs.imageInput.value = ''" 
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
                            <label for="image" class="text-xs text-slate-300 block mb-1">Upload de Arquivo (JPG, PNG, WebP):</label>
                            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml,image/avif,image/heic,image/*" 
                                   x-ref="imageInput"
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
                            @error('image') <span class="text-xs text-rose-400 block mt-1.5 font-medium">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="image_url" class="text-xs text-slate-300 block mb-1">Ou URL direta da Imagem:</label>
                            <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://..." 
                                   class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                            @error('image_url') <span class="text-xs text-rose-400 block mt-1.5 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                @if($course->exists)
                    <!-- Linked Professors (Read-only) -->
                    <div class="sm:col-span-2 space-y-2 p-5 rounded-2xl bg-white/5 border border-white/10">
                        <label class="text-xs font-semibold text-[#F4BF45] uppercase tracking-wider block">Professores Vinculados a este Curso</label>
                        @if($course->teamMembers->isNotEmpty())
                            <div class="flex flex-wrap gap-2 pt-1">
                                @foreach($course->teamMembers as $prof)
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs bg-[#18243d] border border-white/10 text-white">
                                        <span class="w-2 h-2 rounded-full {{ $prof->is_active ? 'bg-emerald-400' : 'bg-slate-500' }}" title="{{ $prof->is_active ? 'Ativo' : 'Inativo' }}"></span>
                                        <span class="font-medium">{{ $prof->name }}</span>
                                        <span class="text-slate-400 text-[11px]">({{ $prof->role }})</span>
                                    </span>
                                @endforeach
                            </div>
                            <p class="text-[11px] text-slate-400 pt-1">
                                Para vincular ou desvincular professores, acesse o formulário de cada docente em <a href="{{ route('admin.team.index') }}" class="text-[#F4BF45] hover:underline font-semibold">Equipe / Docentes</a>.
                            </p>
                        @else
                            <p class="text-xs text-slate-400">Nenhum professor vinculado a este curso no momento. Os vínculos são definidos na edição de cada docente em <a href="{{ route('admin.team.index') }}" class="text-[#F4BF45] hover:underline font-semibold">Equipe / Docentes</a>.</p>
                        @endif
                    </div>
                @endif

                <!-- Toggles & Order -->
                <div class="sm:col-span-2 flex flex-wrap items-center gap-8 pt-2">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }} 
                               class="rounded bg-[#18243d] border-white/20 text-[#F4BF45] focus:ring-0">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Destacar na Home</span>
                    </label>

                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $course->exists ? $course->is_active : true) ? 'checked' : '' }} 
                               class="rounded bg-[#18243d] border-white/20 text-[#F4BF45] focus:ring-0">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Curso Ativo</span>
                    </label>

                    <div class="flex items-center gap-2">
                        <label for="sort_order" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Ordem de Exibição:</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $course->sort_order ?? 0) }}" 
                               class="w-20 bg-[#18243d] border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>
                </div>

            </div>

            <div class="pt-6 border-t border-white/10 flex items-center justify-end gap-3">
                <a href="{{ route('admin.courses.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                    {{ $course->exists ? 'Salvar Alterações' : 'Cadastrar Curso' }}
                </button>
            </div>

        </form>
    </div>
@endsection
