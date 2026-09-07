@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Visão Geral do Sistema')

@section('content')
    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="p-6 rounded-2xl bg-[#131d2e] border border-white/10 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Cursos Cadastrados</span>
                <span class="text-3xl font-extrabold text-white mt-1 block">{{ $stats['courses_count'] }}</span>
                <span class="text-xs text-[#F4BF45]">{{ $stats['active_courses_count'] }} cursos ativos no site</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>

        <div class="p-6 rounded-2xl bg-[#131d2e] border border-white/10 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Turmas Abertas</span>
                <span class="text-3xl font-extrabold text-white mt-1 block">{{ $stats['turmas_count'] }}</span>
                <span class="text-xs text-emerald-400">Inscrições recebendo leads</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <div class="p-6 rounded-2xl bg-[#131d2e] border border-white/10 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Mensagens / Leads</span>
                <span class="text-3xl font-extrabold text-white mt-1 block">{{ $stats['unread_messages'] }}</span>
                <span class="text-xs text-amber-400">Não lidas na caixa de entrada</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <div class="p-6 rounded-2xl bg-[#131d2e] border border-white/10 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Posts no Blog</span>
                <span class="text-3xl font-extrabold text-white mt-1 block">{{ $stats['posts_count'] }}</span>
                <span class="text-xs text-purple-400">{{ $stats['portfolio_count'] }} fotos no portfólio</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="p-6 rounded-2xl bg-[#131d2e] border border-white/10 space-y-4">
        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Ações Rápidas</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gold-gradient text-[#18243d] font-bold text-xs uppercase tracking-wider hover:opacity-95 shadow-gold-glow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Novo Curso</span>
            </a>
            <a href="{{ route('admin.turmas.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-semibold text-xs uppercase tracking-wider transition-colors">
                <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Nova Turma</span>
            </a>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-semibold text-xs uppercase tracking-wider transition-colors">
                <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Novo Post no Blog</span>
            </a>
            <a href="{{ route('admin.portfolio.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-semibold text-xs uppercase tracking-wider transition-colors">
                <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Adicionar Foto ao Portfólio</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-semibold text-xs uppercase tracking-wider transition-colors">
                <svg class="w-4 h-4 text-[#F4BF45]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                <span>Configurar WhatsApp & SEO</span>
            </a>
        </div>
    </div>

    <!-- RECENT MESSAGES & UPCOMING TURMAS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Recent Messages -->
        <div class="p-6 rounded-2xl bg-[#131d2e] border border-white/10 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Últimos Leads / Contatos</h3>
                <a href="{{ route('admin.messages.index') }}" class="text-xs text-[#F4BF45] hover:underline">Ver todos</a>
            </div>

            @if($latestMessages->isEmpty())
                <p class="text-xs text-slate-400 py-4">Nenhuma mensagem recebida ainda.</p>
            @else
                <div class="divide-y divide-white/5">
                    @foreach($latestMessages as $msg)
                        <div class="py-3 flex items-start justify-between gap-4">
                            <div class="space-y-0.5">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-white">{{ $msg->name }}</span>
                                    @if(!$msg->is_read)
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-500/20 text-amber-400">Novo</span>
                                    @endif
                                </div>
                                <div class="text-xs text-slate-400">{{ $msg->email }} • {{ $msg->phone }}</div>
                                <p class="text-xs text-slate-300 line-clamp-1 italic">"{{ $msg->message }}"</p>
                            </div>
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="p-2 text-slate-400 hover:text-[#F4BF45]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Upcoming Turmas -->
        <div class="p-6 rounded-2xl bg-[#131d2e] border border-white/10 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Turmas no Calendário</h3>
                <a href="{{ route('admin.turmas.index') }}" class="text-xs text-[#F4BF45] hover:underline">Ver todas</a>
            </div>

            @if($upcomingTurmas->isEmpty())
                <p class="text-xs text-slate-400 py-4">Nenhuma turma cadastrada.</p>
            @else
                <div class="divide-y divide-white/5">
                    @foreach($upcomingTurmas as $turma)
                        <div class="py-3 flex items-center justify-between gap-4">
                            <div>
                                <div class="text-sm font-bold text-white leading-snug">
                                    {{ $turma->course ? $turma->course->title : $turma->title }}
                                </div>
                                <div class="text-xs text-slate-400 mt-0.5">
                                    @if($turma->start_date) {{ $turma->start_date->format('d/m/Y') }} • @endif
                                    {{ $turma->status }}
                                </div>
                            </div>
                            <a href="{{ route('admin.turmas.edit', $turma->id) }}" class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-200">
                                Editar
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endsection
