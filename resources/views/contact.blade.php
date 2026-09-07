@extends('layouts.app')

@section('title', 'Fale Conosco — IOA Natal | Atendimento Acadêmico')
@section('meta_description', 'Entre em contato com o IOA Natal por WhatsApp ou formulário. Tire suas dúvidas sobre pós-graduação e venha conhecer nossa sede.')

@section('content')
    <!-- PAGE HERO -->
    <section class="py-16 relative bg-[#0e172a]/80 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <span class="text-xs uppercase font-bold tracking-widest text-[#F4BF45]">Canais de Atendimento</span>
            <h1 class="text-4xl sm:text-5xl font-serif font-bold text-white">Fale com Nossos Consultores</h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-base">
                Estamos prontos para atender você, apresentar as condições especiais de cada turma e agendar sua visita guiada às nossas clínicas.
            </p>
        </div>
    </section>

    <!-- CONTACT CONTENT -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left Column: Form & Primary WhatsApp CTA -->
                <div class="lg:col-span-7 space-y-8">
                    
                    <!-- Direct WhatsApp Highlight Card -->
                    <div class="p-8 rounded-3xl bg-gradient-to-r from-[#18243d] via-[#1c2c49] to-[#18243d] border-2 border-[#F4BF45] shadow-gold-glow flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="space-y-2 text-center sm:text-left">
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase bg-[#F4BF45] text-[#18243d]">Canal Prioritário</span>
                            <h3 class="text-xl font-serif font-bold text-white">Atendimento Rápido via WhatsApp</h3>
                            <p class="text-xs text-slate-300">Resposta ágil com um consultor acadêmico especializado.</p>
                        </div>
                        <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" 
                           class="inline-flex items-center gap-2.5 px-6 py-4 rounded-xl font-bold text-xs uppercase tracking-wider text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all shrink-0">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Iniciar Conversa</span>
                        </a>
                    </div>

                    <!-- Contact Form -->
                    <div class="card-glass p-8 sm:p-10 rounded-3xl border border-white/10 space-y-6">
                        <div class="space-y-2">
                            <h3 class="text-2xl font-serif font-bold text-white">Envie uma Mensagem</h3>
                            <p class="text-xs sm:text-sm text-slate-300">Preencha o formulário abaixo e entraremos em contato por e-mail ou telefone.</p>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="name" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Nome Completo *</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                           class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                                    @error('name') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="email" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">E-mail Profissional *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                           class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                                    @error('email') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="phone" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">WhatsApp / Telefone *</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="(84) 99999-9999" 
                                           class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                                    @error('phone') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="course_of_interest" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Curso de Interesse</label>
                                    <select id="course_of_interest" name="course_of_interest" 
                                            class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                                        <option value="">Selecione um curso (opcional)</option>
                                        @foreach($courses as $c)
                                            <option value="{{ $c->title }}" {{ old('course_of_interest') == $c->title ? 'selected' : '' }}>
                                                {{ $c->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="message" class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Sua Mensagem ou Dúvida *</label>
                                <textarea id="message" name="message" rows="4" required 
                                          class="w-full bg-[#18243d]/80 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('message') }}</textarea>
                                @error('message') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" 
                                    class="w-full py-4 rounded-xl font-bold text-xs uppercase tracking-wider text-[#18243d] bg-gold-gradient hover:bg-gold-gradient-hover shadow-gold-glow transition-all duration-300">
                                Enviar Mensagem
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Right Column: Institutional Info & Map -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <div class="card-glass p-8 rounded-3xl border border-white/10 space-y-6">
                        <h3 class="text-xl font-serif font-bold text-white border-b border-white/10 pb-4">
                            Informações da Sede
                        </h3>

                        <div class="space-y-4 text-sm text-slate-300">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#F4BF45] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div>
                                    <strong class="text-white block">Endereço</strong>
                                    <span>{{ setting('address', 'Av. Governador Tarcísio de Vasconcelos Maia, 1500 - Candelária, Natal - RN, CEP 59065-000') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#F4BF45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <div>
                                    <strong class="text-white block">Telefone</strong>
                                    <span>{{ setting('phone', '(84) 3211-9800') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#F4BF45] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <div>
                                    <strong class="text-white block">E-mail</strong>
                                    <span>{{ setting('email', 'contato@ioanatal.com.br') }}</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#F4BF45] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <strong class="text-white block">Horário de Funcionamento</strong>
                                    <span>{{ setting('business_hours', 'Segunda a Sexta: 08:00 às 18:30 | Sábados: 08:00 às 17:00') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Maps Embed -->
                    <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl h-72 bg-slate-800">
                        <iframe 
                            src="{{ setting('google_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3969.191632734139!2d-35.21558232412852!3d-5.828608857771746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7b2ff90fb4b3701%3A0x6b04b503029a1b1b!2sNatal%2C%20RN!5e0!3m2!1spt-BR!2sbr!4v1700000000000!5m2!1spt-BR!2sbr') }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
