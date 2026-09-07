@extends('layouts.admin')

@section('title', 'Detalhes da Mensagem')
@section('header_title', 'Mensagem de ' . $message->name)

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-slate-400 hover:text-[#F4BF45] inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Voltar para todas as mensagens</span>
            </a>

            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Excluir esta mensagem?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 text-xs font-semibold">
                    Excluir Mensagem
                </button>
            </form>
        </div>

        <div class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 shadow-2xl space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-6">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-white">{{ $message->name }}</h2>
                    <div class="text-xs text-slate-400 mt-1">Recebido em {{ $message->created_at->format('d/m/Y \à\s H:i') }} (IP: {{ $message->ip_address ?? 'N/A' }})</div>
                </div>

                @php
                    $cleanPhone = preg_replace('/[^0-9]/', '', $message->phone);
                @endphp
                @if($cleanPhone)
                    <a href="https://wa.me/55{{ $cleanPhone }}?text={{ urlencode("Olá {$message->name}! Recebemos sua mensagem no site do IOA Natal sobre {$message->course_of_interest}.") }}" 
                       target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>Responder no WhatsApp</span>
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-xl bg-white/5 border border-white/5 space-y-1">
                    <span class="text-slate-400 block uppercase font-semibold">E-mail:</span>
                    <a href="mailto:{{ $message->email }}" class="text-white hover:text-[#F4BF45] font-medium text-sm block">
                        {{ $message->email }}
                    </a>
                </div>

                <div class="p-4 rounded-xl bg-white/5 border border-white/5 space-y-1">
                    <span class="text-slate-400 block uppercase font-semibold">Telefone / WhatsApp:</span>
                    <span class="text-white font-medium text-sm block">
                        {{ $message->phone ?? 'Não informado' }}
                    </span>
                </div>

                <div class="sm:col-span-2 p-4 rounded-xl bg-white/5 border border-white/5 space-y-1">
                    <span class="text-slate-400 block uppercase font-semibold">Curso de Interesse:</span>
                    <span class="text-[#FEEAA3] font-bold text-sm block">
                        {{ $message->course_of_interest ?? 'Geral / Não especificado' }}
                    </span>
                </div>
            </div>

            <div class="space-y-2 pt-2">
                <span class="text-xs font-semibold text-[#F4BF45] uppercase tracking-wider block">Mensagem Enviada:</span>
                <div class="p-6 rounded-2xl bg-[#0b1320] border border-white/10 text-slate-200 text-sm leading-relaxed whitespace-pre-line">
                    {{ $message->message }}
                </div>
            </div>

        </div>

    </div>
@endsection
