@extends('layouts.admin')

@section('title', 'Caixa de Mensagens & Leads')
@section('header_title', 'Mensagens / Leads Recebidos')

@section('content')
    <div class="pb-6">
        <h1 class="text-xl font-bold text-white">Leads e Contatos do Site</h1>
        <p class="text-xs text-slate-400">Mensagens enviadas por cirurgiões-dentistas através do formulário institucional.</p>
    </div>

    <div class="bg-[#131d2e] rounded-2xl border border-white/10 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-[#0b1320] text-xs uppercase font-bold text-slate-400 border-b border-white/10">
                    <tr>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Remetente</th>
                        <th class="px-6 py-4">Contato</th>
                        <th class="px-6 py-4">Curso de Interesse</th>
                        <th class="px-6 py-4">Data</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-white/5 transition-colors {{ !$msg->is_read ? 'bg-amber-500/5' : '' }}">
                            <td class="px-6 py-4">
                                @if(!$msg->is_read)
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30">Novo</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-500/10 text-slate-400">Lido</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="font-bold text-white hover:text-[#F4BF45]">
                                    {{ $msg->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                <div>{{ $msg->email }}</div>
                                <div class="text-slate-400">{{ $msg->phone }}</div>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                {{ $msg->course_of_interest ?? 'Geral / Outros' }}
                            </td>
                            <td class="px-6 py-4 text-xs">
                                {{ $msg->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="p-2 text-slate-300 hover:text-[#F4BF45] hover:bg-white/5 rounded-lg" title="Ver Detalhes">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Excluir esta mensagem?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400">Nenhuma mensagem recebida até o momento.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/10">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
