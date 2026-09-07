# Prompt para Criação de Site Institucional — IOA Natal

## Contexto e Objetivo

Crie um site institucional completo e responsivo para a **IOA Natal**, com identidade visual sofisticada baseada em um logotipo de globo terrestre dourado 3D. O site deve transmitir credibilidade, profissionalismo e presença internacional, funcionando tanto como vitrine institucional quanto como ferramenta de captação de leads (via WhatsApp) e comunicação com o público (via Blog).

O site deve incluir um **painel administrativo (CMS)** que permita ao usuário admin editar e publicar conteúdo em todas as páginas sem necessidade de conhecimento técnico.

---

## Identidade Visual

- **Cor predominante:** `#18243d` (azul-marinho escuro profundo) — usada em fundos, cabeçalhos, rodapé e áreas de destaque.
- **Cor de detalhe/acento:** dourado similar a `#F4BF45` — usado em botões, ícones, linhas divisórias, títulos de destaque, hover states e bordas decorativas. Considerar variações em gradiente (dourado claro → dourado escuro) para replicar o efeito metálico do logotipo.
- **Cor de apoio:** branco/off-white (`#FFFFFF` / `#F8F8F6`) para textos sobre fundo escuro e áreas de respiro visual.
- **Logotipo:** globo terrestre dourado 3D (fornecido em anexo), com versão em branco/monocromática para uso sobre fundos escuros. Manter área de proteção ao redor do logo e não distorcer suas proporções.
- **Tipografia:** sugerir uma fonte serifada ou semi-serifada elegante para títulos (transmitindo tradição/institucionalidade) combinada com uma sans-serif limpa e legível para textos corridos.
- **Estilo geral:** elegante, premium, com uso de gradientes sutis dourados, ícones em linha fina (thin line) na cor dourada, e bastante espaço em branco/negativo para não sobrecarregar visualmente o fundo escuro.

---

## Stack Tecnológica

- **Backend:** PHP + Laravel (versão LTS mais recente disponível).
- **Banco de dados:** MySQL.
- **Views/Templates:** Blade (templates do próprio Laravel).
- **Estilização:** Tailwind CSS.
- **Interatividade no front-end:** Alpine.js (para menus, modais, carrosséis, filtros, lightbox do portfólio, etc., sem necessidade de um framework JS pesado).
- **Hospedagem:** Locaweb — plano **Hospedagem I** (hospedagem compartilhada, com SSH e Cronjob inclusos; disco SSD, banco de dados MySQL ilimitado).

### Estrutura sugerida da aplicação (Laravel)
- **Models/Migrations:** `Course` (curso), `Turma` (vinculada a `Course`), `PortfolioItem`, `Post` (blog, com `Category`/`Tag`), `TeamMember`, `PageContent` (para textos editáveis de Home/Sobre/Contato), `User` (admin).
- **Autenticação do admin:** Laravel Breeze (ou solução nativa do Laravel) para login/logout/recuperação de senha, restrita à área `/admin`.
- **Área administrativa:** grupo de rotas `/admin` protegido por middleware `auth`, construído com Blade + Tailwind + Alpine.js (mantendo a mesma stack do site público, sem necessidade de Livewire/Filament — mas caso o desenvolvedor prefira agilidade, **Filament** é uma alternativa robusta a considerar, ciente de que ele introduz Livewire como dependência).
- **Upload e gestão de mídia:** pacote `spatie/laravel-medialibrary` (ou solução própria com `Storage` do Laravel) para imagens de cursos, portfólio, posts e equipe.
- **Editor de texto rico (WYSIWYG) do Blog:** TinyMCE, Quill ou similar, integrado ao formulário de posts no admin.
- **Controle de permissões (opcional/futuro):** `spatie/laravel-permission`, caso seja necessário ter múltiplos níveis de acesso no admin.
- **SEO:** meta tags dinâmicas por página/post, `sitemap.xml` gerado via `spatie/laravel-sitemap`, URLs amigáveis (slugs) para cursos, turmas, portfólio e posts.
- **Agendamento de posts do blog:** Laravel Scheduler (`artisan schedule:run`) configurado via cron job no servidor.

### Considerações específicas do plano Hospedagem I (Locaweb)

O **Hospedagem I** é um plano de hospedagem **compartilhada** (diferente de um VPS/Cloud ou Hospedagem Dedicada), então alguns cuidados extras são necessários para rodar Laravel nele com estabilidade:

- **SSH e Cronjob já estão incluídos no plano** — o que viabiliza o deploy. Porém, por ser ambiente compartilhado, é comum que funções PHP sensíveis (`symlink()`, `exec()`, `proc_open()`, `putenv()`) estejam desabilitadas por segurança. Antes de iniciar o desenvolvimento, valide via SSH quais funções estão bloqueadas:
  ```
  php -i | grep disable_functions
  ```
- **Composer:** para evitar problemas de memória/timeout ou funções bloqueadas ao rodar o Composer diretamente no servidor, a abordagem mais segura é rodar `composer install --no-dev --optimize-autoloader` **localmente** (ou em CI) e depois enviar a pasta `vendor/` já pronta via SSH/SFTP junto com o restante da aplicação.
- **Document root fixo em `public_html`:** diferente de um VPS, normalmente não é possível apontar o document root para a subpasta `public/` do Laravel nesse plano. A solução comum em hospedagem compartilhada é: enviar o projeto Laravel completo **um nível acima** de `public_html`, mover o conteúdo da pasta `public/` do Laravel para dentro de `public_html`, e ajustar os caminhos de `require` no `index.php` para apontar corretamente para `../bootstrap/app.php` e `../vendor/autoload.php`. Isso também impede acesso externo direto ao `.env` e ao restante do código-fonte.
- **`storage:link`:** como `symlink()` pode estar desabilitado, tenha um plano B — servir os arquivos de mídia via uma rota/controller do Laravel que faça streaming do conteúdo de `storage/app/public`, ou copiar fisicamente os arquivos enviados para dentro de `public_html/storage` em vez de depender de link simbólico.
- **Versão do PHP:** confirme no painel da Hospedagem I qual a versão máxima de PHP disponível atualmente. Laravel 11/12 exigem PHP 8.2+; se o plano só oferecer até PHP 8.1, opte por **Laravel 10.x (LTS)**, compatível com PHP 8.1.
- **Cron job:** configurar no painel da Locaweb a execução de `php artisan schedule:run` a cada minuto (necessário para agendamento de posts do blog e outras tarefas futuras).
- Manter o arquivo `.env` com permissões restritas e fora do alcance público, protegendo credenciais do banco MySQL.
- **Recomendação prática:** antes de desenvolver o site completo, faça um teste rápido de deploy ("Hello Laravel") nesse ambiente para validar rotas, conexão com o MySQL, upload/exibição de arquivos e o cron do scheduler — evitando retrabalho caso alguma limitação apareça no meio do projeto. Se restrições do ambiente compartilhado se mostrarem bloqueantes sem alternativa viável, a Locaweb permite upgrade para VPS/Cloud, mas o objetivo é viabilizar tudo dentro do Hospedagem I já contratado.

---

## Estrutura do Site (Páginas)

### 1. Home
- Seção hero de destaque com o logotipo, headline institucional e CTA principal (ex: "Fale conosco" ou "Conheça nossos cursos"), levando ao WhatsApp ou à página de cursos.
- Bloco de apresentação rápida da instituição (resumo do "Sobre nós").
- Destaque/vitrine dos principais cursos (cards com imagem, título, resumo e botão "Saiba mais").
- Seção de turmas em destaque ou próximas turmas com inscrições abertas.
- Prévia do portfólio (galeria/carrossel com 4–6 itens e link "Ver portfólio completo").
- Últimos posts do blog (3 cards mais recentes).
- Seção de depoimentos/prova social (opcional, mas recomendado).
- Faixa final de contato/CTA com botão flutuante ou fixo do WhatsApp.
- Rodapé institucional com menu, redes sociais, endereço e botão de WhatsApp.

### 2. Sobre Nós
- História da instituição, missão, visão e valores.
- Diferenciais competitivos.
- Equipe/corpo docente (fotos, nomes, cargos/especialidades) — gerenciável via CMS.
- Linha do tempo ou marcos importantes (opcional).
- Certificações, parcerias ou reconhecimentos (logos de parceiros, se houver).

### 3. Nossos Cursos
- Listagem de cursos em formato grid/cards, com filtro por categoria (ex: idiomas, negócios, presencial/online).
- Cada curso deve ter página própria com: descrição completa, carga horária, público-alvo, conteúdo programático, investimento (ou "consulte valores"), botão de inscrição/contato via WhatsApp.
- Estrutura pensada para o admin poder adicionar/editar/remover cursos livremente pelo CMS.

### 4. Turmas
- Listagem de turmas disponíveis vinculadas aos cursos (data de início, horário, modalidade — presencial/online, vagas disponíveis).
- Status da turma (ex: "Inscrições abertas", "Em andamento", "Encerrada") — editável via CMS.
- Botão de inscrição/interesse que direciona ao WhatsApp com mensagem pré-preenchida citando a turma específica.

### 5. Portfólio
- Galeria de projetos, eventos, turmas formadas ou trabalhos realizados — formato grid com imagens em destaque.
- Filtro por categoria/ano (opcional).
- Lightbox para ampliar imagens.
- Totalmente gerenciável via CMS (admin deve poder adicionar novos itens com imagem, título e descrição curta).

### 6. Blog
- Listagem de posts em formato de grid ou lista, com imagem de capa, título, resumo, data e categoria.
- Página individual de post com conteúdo formatado (títulos, imagens, listas, citações).
- Sistema de categorias/tags.
- Campo de busca (opcional).
- Compartilhamento em redes sociais (opcional).
- Totalmente gerenciável via CMS: admin deve poder criar, editar, agendar e excluir posts, com editor de texto rico (WYSIWYG) e upload de imagens.

### 7. Contato
- Formulário simples (nome, e-mail, mensagem) — opcional, complementar ao WhatsApp.
- **Botão/link principal deve redirecionar diretamente para o WhatsApp** (via link `https://wa.me/[número]?text=[mensagem pré-definida]`), preferencialmente com destaque visual em dourado.
- Informações institucionais: endereço, telefone, e-mail, redes sociais, mapa incorporado (Google Maps).
- Horário de atendimento.
- Botão flutuante de WhatsApp presente em todas as páginas do site (não só na página de contato).

---

## Painel Administrativo (CMS)

O site deve contar com uma área administrativa (`/admin`) construída em Blade + Tailwind + Alpine.js, protegida por login (usuário/senha, com opção de recuperação de senha via Laravel Breeze ou similar), permitindo ao admin:

- **Gestão de conteúdo por página:** editar textos, imagens e seções de Home, Sobre Nós e Contato.
- **Gestão de Cursos:** criar, editar, excluir e reordenar cursos, com upload de imagens e campos customizados (carga horária, programa, etc.).
- **Gestão de Turmas:** criar, editar e atualizar status de turmas, vinculando-as aos cursos correspondentes.
- **Gestão de Portfólio:** upload e organização de imagens/projetos, com categorização.
- **Gestão de Blog:** editor de texto rico (WYSIWYG) para criação de posts, upload de imagens, categorias/tags, opção de rascunho, publicação imediata ou agendada.
- **Gestão de mídia (biblioteca de arquivos):** upload centralizado de imagens/documentos reutilizáveis em várias páginas.
- **Configurações gerais:** número de WhatsApp, redes sociais, informações de contato, SEO básico (meta título/descrição por página).
- **Controle de usuários:** possibilidade de criar múltiplos usuários admin com diferentes níveis de permissão (opcional, mas recomendado para escalabilidade futura).
- Interface do painel administrativo deve ser simples, intuitiva e em português, seguindo um padrão visual limpo (não precisa replicar o dourado/azul do site público, mas deve ser profissional).

---

## Requisitos Técnicos

- Design **totalmente responsivo** (mobile, tablet, desktop), construído com Tailwind CSS (mobile-first).
- Performance otimizada: imagens comprimidas/otimizadas (considerar conversão para WebP), assets compilados via Vite (padrão do Laravel para Tailwind/Alpine.js), cache de rotas/config/views do Laravel habilitado em produção (`artisan config:cache`, `route:cache`, `view:cache`).
- SEO on-page básico (meta tags dinâmicas, URLs amigáveis via slugs, `sitemap.xml`, dados estruturados/Schema.org para posts do blog e cursos).
- Botão de WhatsApp flutuante fixo em todas as páginas (componente Blade reutilizável).
- Integração com Google Analytics/Meta Pixel (opcional, mas recomendado).
- Certificado SSL (HTTPS) configurado no domínio via painel Locaweb.
- Acessibilidade básica (contraste adequado entre o dourado/azul-marinho e o texto, alt text em imagens).
- Backups periódicos do banco de dados MySQL (verificar rotina de backup automático oferecida pela Locaweb ou configurar rotina própria via cron).
- Versionamento do código via Git (recomendado, independente do Locaweb oferecer ou não integração direta de deploy).

---

## Tom e Estilo de Comunicação

Textos institucionais devem transmitir **confiança, tradição e profissionalismo internacional**, com linguagem clara e acessível, evitando jargões excessivos. O dourado deve ser usado com moderação — como elemento de destaque e sofisticação — evitando poluição visual sobre o fundo azul-marinho escuro.

---

*Observação: este prompt está estruturado como briefing técnico para um desenvolvedor/agência trabalhando com PHP + Laravel + MySQL + Blade + Tailwind + Alpine.js, hospedado na Locaweb. Antes de iniciar o desenvolvimento, confirme junto ao suporte da Locaweb qual plano contratado (Hospedagem Dedicada, Cloud/VPS, etc.) e se ele oferece acesso SSH completo e suporte a Composer/artisan — isso evita retrabalho na etapa de deploy.*
