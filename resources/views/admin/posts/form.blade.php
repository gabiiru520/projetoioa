@extends('layouts.admin')

@section('title', $post->exists ? 'Editar Artigo' : 'Novo Artigo do Blog')
@section('header_title', $post->exists ? 'Editar Artigo: ' . $post->title : 'Escrever Novo Artigo')

@section('extra_head')
    <!-- TinyMCE CDN integration for rich WYSIWYG editing -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: '#content',
                    height: 500,
                    skin: 'oxide-dark',
                    content_css: 'dark',
                    menubar: false,
                    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
                    toolbar: 'undo redo | blocks | bold italic underline forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image table | code',
                    content_style: 'body { font-family: Plus Jakarta Sans, sans-serif; font-size: 15px; color: #f1f5f9; background: #0e172a; line-height: 1.7; }'
                });
            }
        });
    </script>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.posts.index') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar para artigos</span>
            </a>
        </div>

        <form action="{{ $post->exists ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" 
              method="POST" enctype="multipart/form-data" 
              class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-6 shadow-2xl">
            @csrf
            @if($post->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Title -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="title" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Título do Artigo *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('title') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Slug -->
                <div class="space-y-1">
                    <label for="slug" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Slug da URL (opcional)</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="gerado automaticamente a partir do título" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Category -->
                <div class="space-y-1">
                    <label for="category" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Categoria *</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $post->category ?? 'Geral') }}" required placeholder="Ex: Implantodontia & Tecnologia" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Author -->
                <div class="space-y-1">
                    <label for="author" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Autor *</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $post->author ?? 'Equipe IOA Natal') }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Status -->
                <div class="space-y-1">
                    <label for="status" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Status *</label>
                    <select id="status" name="status" required 
                            class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Publicado Imediatamente</option>
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Rascunho (não visível)</option>
                        <option value="scheduled" {{ old('status', $post->status) === 'scheduled' ? 'selected' : '' }}>Agendado para Data Futura</option>
                    </select>
                </div>

                <!-- Published At -->
                <div class="space-y-1">
                    <label for="published_at" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Data de Publicação</label>
                    <input type="datetime-local" id="published_at" name="published_at" 
                           value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Tags -->
                <div class="space-y-1">
                    <label for="tags" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Tags (separadas por vírgula)</label>
                    <input type="text" id="tags" name="tags" value="{{ old('tags', $post->tags) }}" placeholder="Ex: Implantodontia, Fluxo Digital, 3D" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Excerpt -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="excerpt" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Resumo / Linha Fina (aparece nos cards)</label>
                    <textarea id="excerpt" name="excerpt" rows="2" 
                              class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <!-- Content WYSIWYG -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="content" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Conteúdo do Artigo *</label>
                    <textarea id="content" name="content" rows="12" 
                              class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('content', $post->content) }}</textarea>
                    @error('content') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Image Upload & URL -->
                <div class="sm:col-span-2 space-y-3 p-5 rounded-2xl bg-white/5 border border-white/10"
                     x-data="{ previewUrl: null, fileName: '', fileSize: '', isOversized: false }">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-semibold text-[#F4BF45] uppercase tracking-wider block">Imagem de Capa do Artigo</label>
                        <span class="text-[11px] text-slate-400">Máx: 20 MB (JPG, PNG, WEBP, GIF, SVG)</span>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-6 py-2">
                        @if($post->image)
                            <div class="space-y-1.5">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Capa Atual</span>
                                <img src="{{ asset_media($post->image) }}" class="w-32 h-20 object-cover rounded-xl border border-white/20 shadow-md">
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
                            <label for="image" class="text-xs text-slate-300 block mb-1">Upload de Arquivo:</label>
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
                            <label for="image_url" class="text-xs text-slate-300 block mb-1">Ou URL externa da Imagem:</label>
                            <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://..." 
                                   class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                            @error('image_url') <span class="text-xs text-rose-400 block mt-1.5 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            </div>

            <div class="pt-6 border-t border-white/10 flex items-center justify-end gap-3">
                <a href="{{ route('admin.posts.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                    {{ $post->exists ? 'Salvar Alterações' : 'Publicar Artigo' }}
                </button>
            </div>

        </form>
    </div>
@endsection
