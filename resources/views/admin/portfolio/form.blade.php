@extends('layouts.admin')

@section('title', $item->exists ? 'Editar Item do Portfólio' : 'Nova Foto no Portfólio')
@section('header_title', $item->exists ? 'Editar Foto: ' . $item->title : 'Adicionar Foto ao Portfólio')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.portfolio.index') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar para portfólio</span>
            </a>
        </div>

        <form action="{{ $item->exists ? route('admin.portfolio.update', $item->id) : route('admin.portfolio.store') }}" 
              method="POST" enctype="multipart/form-data" 
              class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-6 shadow-2xl">
            @csrf
            @if($item->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Title -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="title" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Título da Foto / Projeto *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $item->title) }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('title') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div class="space-y-1">
                    <label for="category" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Categoria *</label>
                    <select id="category" name="category" required 
                            class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        @foreach(['Instalações', 'Centro Cirúrgico', 'Tecnologia', 'Aulas Práticas', 'Turmas Formadas', 'Eventos'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $item->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date Label -->
                <div class="space-y-1">
                    <label for="date_label" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Legenda / Subtítulo</label>
                    <input type="text" id="date_label" name="date_label" value="{{ old('date_label', $item->date_label) }}" placeholder="Ex: Sede Natal/RN ou Turma 2025" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Description -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="description" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Descrição Curta</label>
                    <textarea id="description" name="description" rows="3" 
                              class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('description', $item->description) }}</textarea>
                </div>

                <!-- Image Upload & URL -->
                <div class="sm:col-span-2 space-y-2 p-5 rounded-2xl bg-white/5 border border-white/10">
                    <label class="text-xs font-semibold text-[#F4BF45] uppercase tracking-wider block">Imagem *</label>
                    
                    @if($item->image)
                        <div class="flex items-center gap-4 py-2">
                            <img src="{{ asset_media($item->image) }}" class="w-24 h-16 object-cover rounded-xl border border-white/20">
                            <span class="text-xs text-slate-400">Imagem atual.</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label for="image" class="text-xs text-slate-300 block mb-1">Upload de Arquivo:</label>
                            <input type="file" id="image" name="image" accept="image/*" 
                                   class="text-xs text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#F4BF45] file:text-[#18243d] hover:file:opacity-90">
                        </div>
                        <div>
                            <label for="image_url" class="text-xs text-slate-300 block mb-1">Ou URL externa da Imagem:</label>
                            <input type="url" id="image_url" name="image_url" placeholder="https://..." 
                                   class="w-full bg-[#18243d] border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                        </div>
                    </div>
                </div>

                <!-- Toggles & Order -->
                <div class="sm:col-span-2 flex flex-wrap items-center gap-8 pt-2">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $item->is_featured) ? 'checked' : '' }} 
                               class="rounded bg-[#18243d] border-white/20 text-[#F4BF45] focus:ring-0">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Destacar na Home</span>
                    </label>

                    <div class="flex items-center gap-2">
                        <label for="sort_order" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Ordem:</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" 
                               class="w-20 bg-[#18243d] border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>
                </div>

            </div>

            <div class="pt-6 border-t border-white/10 flex items-center justify-end gap-3">
                <a href="{{ route('admin.portfolio.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                    {{ $item->exists ? 'Salvar Alterações' : 'Salvar no Portfólio' }}
                </button>
            </div>

        </form>
    </div>
@endsection
