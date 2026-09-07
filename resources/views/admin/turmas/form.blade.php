@extends('layouts.admin')

@section('title', $turma->exists ? 'Editar Turma' : 'Nova Turma')
@section('header_title', $turma->exists ? 'Editar Turma: ' . $turma->title : 'Cadastrar Nova Turma')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.turmas.index') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar para turmas</span>
            </a>
        </div>

        <form action="{{ $turma->exists ? route('admin.turmas.update', $turma->id) : route('admin.turmas.store') }}" 
              method="POST" 
              class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-6 shadow-2xl">
            @csrf
            @if($turma->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Course Select -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="course_id" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Vincular ao Curso *</label>
                    <select id="course_id" name="course_id" required 
                            class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        <option value="">Selecione um curso</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ old('course_id', $turma->course_id) == $c->id ? 'selected' : '' }}>
                                {{ $c->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Title / Code -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="title" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Identificação da Turma *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $turma->title) }}" required placeholder="Ex: Turma 2026.1 ou Turma Março 2026" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    @error('title') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <!-- Start Date -->
                <div class="space-y-1">
                    <label for="start_date" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Data de Início Prevista</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $turma->start_date ? $turma->start_date->format('Y-m-d') : '') }}" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Status -->
                <div class="space-y-1">
                    <label for="status" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Status das Inscrições *</label>
                    <select id="status" name="status" required 
                            class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                        @foreach(['Inscrições abertas', 'Últimas vagas', 'Em andamento', 'Encerrada'] as $st)
                            <option value="{{ $st }}" {{ old('status', $turma->status ?? 'Inscrições abertas') == $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Schedule -->
                <div class="space-y-1">
                    <label for="schedule" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Horários / Dias</label>
                    <input type="text" id="schedule" name="schedule" value="{{ old('schedule', $turma->schedule) }}" placeholder="Ex: Quinta a Sábado - Mensal" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Spots -->
                <div class="space-y-1">
                    <label for="spots" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Vagas Disponíveis / Alerta</label>
                    <input type="text" id="spots" name="spots" value="{{ old('spots', $turma->spots) }}" placeholder="Ex: Últimas 4 vagas ou 12 vagas no total" 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Modality -->
                <div class="space-y-1">
                    <label for="modality" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Modalidade *</label>
                    <input type="text" id="modality" name="modality" value="{{ old('modality', $turma->modality ?? 'Presencial') }}" required 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- WhatsApp Message Custom -->
                <div class="sm:col-span-2 space-y-1">
                    <label for="whatsapp_message" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Mensagem pré-preenchida para o WhatsApp (opcional)</label>
                    <input type="text" id="whatsapp_message" name="whatsapp_message" value="{{ old('whatsapp_message', $turma->whatsapp_message) }}" placeholder="Ex: Olá! Gostaria de garantir minha vaga na turma..." 
                           class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                </div>

                <!-- Is featured -->
                <div class="sm:col-span-2 pt-2">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $turma->is_featured) ? 'checked' : '' }} 
                               class="rounded bg-[#18243d] border-white/20 text-[#F4BF45] focus:ring-0">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Destacar na Página Inicial</span>
                    </label>
                </div>

            </div>

            <div class="pt-6 border-t border-white/10 flex items-center justify-end gap-3">
                <a href="{{ route('admin.turmas.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-300">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                    {{ $turma->exists ? 'Salvar Alterações' : 'Criar Turma' }}
                </button>
            </div>

        </form>
    </div>
@endsection
