@extends('layouts.admin')

@section('title', 'Corpo Docente')
@section('header_title', 'Equipe & Professores')

@section('content')
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6">
        <div>
            <h1 class="text-xl font-bold text-white">Corpo Docente & Coordenação</h1>
            <p class="text-xs text-slate-400">Cadastre e organize os professores, doutores e coordenadores da instituição.</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Novo Docente</span>
        </a>
    </div>

    <div class="bg-[#131d2e] rounded-2xl border border-white/10 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-[#0b1320] text-xs uppercase font-bold text-slate-400 border-b border-white/10">
                    <tr>
                        <th class="px-6 py-4">Professor</th>
                        <th class="px-6 py-4">Cargo / Titulação</th>
                        <th class="px-6 py-4">CRO</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($members as $member)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset_media($member->photo) }}" alt="" class="w-10 h-10 rounded-full object-cover bg-slate-800 shrink-0">
                                    <span class="font-bold text-white">{{ $member->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                {{ $member->role }}
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-[#FEEAA3]">
                                {{ $member->cro ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($member->is_active)
                                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Ativo</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-slate-500/10 text-slate-400">Inativo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.team.edit', $member->id) }}" class="p-2 text-slate-300 hover:text-[#F4BF45] hover:bg-white/5 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Excluir este membro da equipe?')">
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
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">Nenhum membro cadastrado na equipe.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/10">
            {{ $members->links() }}
        </div>
    </div>
@endsection
