@extends('layouts.admin')

@section('title', 'Configurações Gerais')
@section('header_title', 'Configurações do Sistema')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        
        <div>
            <h1 class="text-xl font-bold text-white">Configurações Gerais & Canais</h1>
            <p class="text-xs text-slate-400">Edite os canais de contato, dados do WhatsApp, redes sociais e SEO global.</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-[#131d2e] rounded-3xl border border-white/10 p-8 space-y-8 shadow-2xl">
            @csrf

            <!-- Section 1: WhatsApp & Canais Imediatos -->
            <div class="space-y-4">
                <h3 class="text-sm font-serif font-bold text-[#F4BF45] uppercase tracking-wider border-b border-white/10 pb-2">
                    Configurações do WhatsApp (Canal Principal de Leads)
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label for="whatsapp_number" class="text-xs font-semibold text-slate-300 uppercase">Número do WhatsApp (com DDI e DDD)</label>
                        <input type="text" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '5584998765432') }}" required 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]" placeholder="Ex: 5584999999999">
                        <span class="text-[11px] text-slate-400">Insira apenas números (55 para Brasil + DDD + número).</span>
                    </div>

                    <div class="space-y-1">
                        <label for="phone" class="text-xs font-semibold text-slate-300 uppercase">Telefone Fixo / Comercial (exibição)</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]" placeholder="(84) 3211-9800">
                    </div>

                    <div class="sm:col-span-2 space-y-1">
                        <label for="whatsapp_default_message" class="text-xs font-semibold text-slate-300 uppercase">Mensagem Padrão do WhatsApp (Site)</label>
                        <input type="text" id="whatsapp_default_message" name="whatsapp_default_message" value="{{ old('whatsapp_default_message', $settings['whatsapp_default_message'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>
                </div>
            </div>

            <!-- Section 2: Dados Institucionais -->
            <div class="space-y-4">
                <h3 class="text-sm font-serif font-bold text-[#F4BF45] uppercase tracking-wider border-b border-white/10 pb-2">
                    Dados Institucionais & Localização
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label for="site_name" class="text-xs font-semibold text-slate-300 uppercase">Nome da Instituição</label>
                        <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label for="email" class="text-xs font-semibold text-slate-300 uppercase">E-mail Institucional</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="sm:col-span-2 space-y-1">
                        <label for="address" class="text-xs font-semibold text-slate-300 uppercase">Endereço Completo</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $settings['address'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="sm:col-span-2 space-y-1">
                        <label for="business_hours" class="text-xs font-semibold text-slate-300 uppercase">Horário de Atendimento</label>
                        <input type="text" id="business_hours" name="business_hours" value="{{ old('business_hours', $settings['business_hours'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="sm:col-span-2 space-y-1">
                        <label for="google_maps_embed" class="text-xs font-semibold text-slate-300 uppercase">URL do Mapa Google Maps (Embed src)</label>
                        <input type="text" id="google_maps_embed" name="google_maps_embed" value="{{ old('google_maps_embed', $settings['google_maps_embed'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>
                </div>
            </div>

            <!-- Section 3: Redes Sociais -->
            <div class="space-y-4">
                <h3 class="text-sm font-serif font-bold text-[#F4BF45] uppercase tracking-wider border-b border-white/10 pb-2">
                    Redes Sociais
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label for="instagram" class="text-xs font-semibold text-slate-300 uppercase">Instagram</label>
                        <input type="url" id="instagram" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" placeholder="https://instagram.com/..." 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label for="facebook" class="text-xs font-semibold text-slate-300 uppercase">Facebook</label>
                        <input type="url" id="facebook" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" placeholder="https://facebook.com/..." 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label for="youtube" class="text-xs font-semibold text-slate-300 uppercase">YouTube</label>
                        <input type="url" id="youtube" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}" placeholder="https://youtube.com/..." 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label for="linkedin" class="text-xs font-semibold text-slate-300 uppercase">LinkedIn</label>
                        <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin', $settings['linkedin'] ?? '') }}" placeholder="https://linkedin.com/..." 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>
                </div>
            </div>

            <!-- Section 4: SEO Global -->
            <div class="space-y-4">
                <h3 class="text-sm font-serif font-bold text-[#F4BF45] uppercase tracking-wider border-b border-white/10 pb-2">
                    SEO & Otimização para Motores de Busca (Google)
                </h3>

                <div class="space-y-4">
                    <div class="space-y-1">
                        <label for="seo_meta_title" class="text-xs font-semibold text-slate-300 uppercase">Título Padrão (Meta Title)</label>
                        <input type="text" id="seo_meta_title" name="seo_meta_title" value="{{ old('seo_meta_title', $settings['seo_meta_title'] ?? '') }}" 
                               class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">
                    </div>

                    <div class="space-y-1">
                        <label for="seo_meta_description" class="text-xs font-semibold text-slate-300 uppercase">Descrição Padrão (Meta Description)</label>
                        <textarea id="seo_meta_description" name="seo_meta_description" rows="3" 
                                  class="w-full bg-[#18243d] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#F4BF45]">{{ old('seo_meta_description', $settings['seo_meta_description'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-white/10 flex justify-end">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-gold-gradient hover:bg-gold-gradient-hover text-[#18243d] font-bold text-xs uppercase tracking-wider shadow-gold-glow">
                    Salvar Todas as Configurações
                </button>
            </div>

        </form>
    </div>
@endsection
