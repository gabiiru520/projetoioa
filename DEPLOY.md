# Deploy — IOA Natal na Locaweb (FTP / Windows IIS)

> **Stack:** Laravel 11 · PHP 8.2/8.3 · MySQL Locaweb · Tailwind CSS (Vite) · Alpine.js
>
> **Ambiente do servidor:** Windows Server + IIS · **Sem SSH disponível** · Deploy exclusivo via FTP
>
> **Estrutura pré-existente no servidor:**
> ```
> /            ← raiz da conta FTP
> ├── -/
> │   └── web/   ← Document Root público (ioanatal.com.br aponta aqui)
> └── dados/     ← pasta protegida (fora da web — ideal para o Laravel)
> ```

---

## Sumário

1. [Diagnóstico do Erro 500 Atual](#1-diagnóstico-do-erro-500-atual)
2. [Estrutura de Diretórios Definitiva no Servidor](#2-estrutura-de-diretórios-definitiva-no-servidor)
3. [Preparação Local (Build e Dependências)](#3-preparação-local-build-e-dependências)
4. [O que Enviar via FTP — Passo a Passo](#4-o-que-enviar-via-ftp--passo-a-passo)
5. [Ajuste do index.php na Pasta Pública](#5-ajuste-do-indexphp-na-pasta-pública)
6. [Arquivo web.config (IIS) na Pasta Pública](#6-arquivo-webconfig-iis-na-pasta-pública)
7. [Configuração do .env de Produção](#7-configuração-do-env-de-produção)
8. [Versão do PHP e Extensões no Painel](#8-versão-do-php-e-extensões-no-painel)
9. [Banco de Dados MySQL na Locaweb](#9-banco-de-dados-mysql-na-locaweb)
10. [Permissões de Escrita (storage e cache)](#10-permissões-de-escrita-storage-e-cache)
11. [Migrations, Seeders e Otimizações (sem SSH)](#11-migrations-seeders-e-otimizações-sem-ssh)
12. [SSL (HTTPS Gratuito)](#12-ssl-https-gratuito)
13. [E-mail SMTP Locaweb](#13-e-mail-smtp-locaweb)
14. [Agendador de Tarefas (Scheduled Tasks IIS)](#14-agendador-de-tarefas-scheduled-tasks-iis)
15. [Checklist Pós-Deploy](#15-checklist-pós-deploy)
16. [Deploy de Atualizações Futuras](#16-deploy-de-atualizações-futuras)
17. [Troubleshooting Rápido](#17-troubleshooting-rápido)

---

## 1. Diagnóstico do Erro 500 Atual

O erro `500 - Internal server error` exibido em `ioanatal.com.br` tem causas identificáveis sem SSH. Siga a ordem abaixo.

### 1.1 Ativar erros detalhados temporariamente

No `web.config` dentro de `/-/web/` (edite via **Gerenciador de Arquivos do Painel Locaweb** ou FTP), altere:

```xml
<httpErrors errorMode="DetailedLocalOnly" />
```
para:
```xml
<httpErrors errorMode="Detailed" />
```

Acesse o site novamente — o IIS mostrará a mensagem de erro completa no navegador. **Reverta esta alteração após o diagnóstico.**

### 1.2 Causas mais comuns do erro 500 na Locaweb / IIS

| Código IIS | Causa provável | Solução |
|:---|:---|:---|
| `500.19` | `web.config` com sintaxe inválida ou módulo ausente | [Seção 6](#6-arquivo-webconfig-iis-na-pasta-pública) |
| `500.52` | Módulo URL Rewrite não instalado no IIS | Contatar suporte Locaweb |
| `500.0` | PHP na versão errada ou extensão faltando | [Seção 8](#8-versão-do-php-e-extensões-no-painel) |
| Página em branco | `APP_DEBUG=false` no `.env` ocultando o erro | Ativar `APP_DEBUG=true` e verificar `dados/laravel/storage/logs/laravel.log` |
| `require` falhou | `index.php` aponta para `../vendor/` (caminho local) | [Seção 5](#5-ajuste-do-indexphp-na-pasta-pública) ← **causa mais provável** |
| Erro de banco | `DB_HOST=localhost` — inválido na Locaweb | [Seção 9](#9-banco-de-dados-mysql-na-locaweb) |

> **⚠️ Causa mais provável no caso atual:** O `index.php` em `/-/web/` ainda aponta para `../vendor/` (estrutura local), mas o Laravel não está em `dados/laravel/` — provavelmente não foi enviado via FTP. Siga a partir da [Seção 3](#3-preparação-local-build-e-dependências).

---

## 2. Estrutura de Diretórios Definitiva no Servidor

```
/                                      ← raiz da conta FTP
├── -/
│   └── web/                           ← Document Root público (ioanatal.com.br)
│       ├── build/                     ← CSS e JS compilados pelo Vite
│       ├── images/                    ← Imagens estáticas
│       ├── web.config                 ← Regras IIS (URL Rewrite + segurança)
│       ├── .user.ini                  ← Limites de memória/upload do PHP
│       ├── favicon.ico
│       ├── favicon.svg
│       ├── robots.txt
│       ├── sitemap.xml
│       └── index.php                  ← ⚡ Aponta para /dados/laravel/
│
└── dados/
    └── laravel/                       ← Código-fonte protegido (fora da web)
        ├── app/
        ├── bootstrap/
        ├── config/
        ├── database/
        ├── resources/
        ├── routes/
        ├── storage/
        ├── vendor/
        ├── artisan
        ├── composer.json
        └── .env                       ← Credenciais reais de produção
```

> **Por quê `dados/laravel/` e não `dados/` direto?**
> A pasta `dados/` pode ter arquivos pré-existentes da Locaweb. Criar a subpasta `laravel/` isola o projeto e evita conflitos.

---

## 3. Preparação Local (Build e Dependências)

Execute na sua máquina local, dentro da pasta do projeto (`c:\Users\yurii\OneDrive\Documentos\Projects\ioanatal`):

### 3.1 Compilar os assets com Vite

```powershell
npm install
npm run build
```

Isso gera/atualiza a pasta `public/build/`.

### 3.2 Instalar dependências PHP otimizadas para produção

```powershell
composer install --no-dev --optimize-autoloader
```

> **Não execute `composer install` no servidor.** A Locaweb compartilhada não tem Composer disponível via painel e a pasta `vendor/` deve ser enviada pronta via FTP.

---

## 4. O que Enviar via FTP — Passo a Passo

Use **FileZilla**, **WinSCP** ou o **Gerenciador de Arquivos do Painel Locaweb**.

### 4.1 Dados de conexão FTP

| Campo | Valor |
|:---|:---|
| **Host / Servidor** | `ftp.ioanatal.com.br` (ou o hostname exibido no painel) |
| **Porta** | `21` |
| **Protocolo** | FTP com TLS explícito (FTPS) — se disponível |
| **Usuário** | Usuário FTP da hospedagem (painel Locaweb) |
| **Senha** | Senha FTP configurada no painel |

### 4.2 Enviar o núcleo do Laravel → `dados/laravel/`

Crie a subpasta `laravel/` dentro de `dados/` (se não existir) e envie o projeto completo, **exceto** os itens abaixo:

| NÃO enviar | Motivo |
|:---|:---|
| `node_modules/` | Desnecessário no servidor |
| `.git/` | Versionamento local apenas |
| `public/` | O conteúdo vai para `/-/web/`, não aqui |
| `database/database.sqlite` | Será usado MySQL em produção |
| `.env` | Criado diretamente no servidor (Seção 7) |

**Mapeamento local → remoto:**

| Local (sua máquina) | Remoto (FTP) |
|:---|:---|
| `app/` | `dados/laravel/app/` |
| `bootstrap/` | `dados/laravel/bootstrap/` |
| `config/` | `dados/laravel/config/` |
| `database/` | `dados/laravel/database/` |
| `resources/` | `dados/laravel/resources/` |
| `routes/` | `dados/laravel/routes/` |
| `storage/` | `dados/laravel/storage/` |
| `vendor/` | `dados/laravel/vendor/` |
| `artisan` | `dados/laravel/artisan` |
| `composer.json` | `dados/laravel/composer.json` |

### 4.3 Enviar os arquivos públicos → `/-/web/`

| Local (sua máquina) | Remoto (FTP) | Observação |
|:---|:---|:---|
| `public/build/` | `/-/web/build/` | |
| `public/images/` | `/-/web/images/` | |
| `public/index.php` | `/-/web/index.php` | ⚡ Editar ANTES — ver Seção 5 |
| `public/web.config` | `/-/web/web.config` | Substituir pelo da Seção 6 |
| `public/.user.ini` | `/-/web/.user.ini` | |
| `public/favicon.ico` | `/-/web/favicon.ico` | |
| `public/favicon.svg` | `/-/web/favicon.svg` | |
| `public/robots.txt` | `/-/web/robots.txt` | |
| `public/sitemap.xml` | `/-/web/sitemap.xml` | |

> **Não envie** `public/.env` — esse arquivo não deve existir na pasta pública.

---

## 5. Ajuste do index.php na Pasta Pública

O `index.php` padrão do Laravel aponta para `../vendor/` (pasta irmã do `public/` na estrutura local). No servidor da Locaweb, o Laravel está em `dados/laravel/`, portanto os caminhos precisam ser corrigidos.

**Edite o arquivo `public/index.php` localmente** antes de enviá-lo para `/-/web/`:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Modo de manutenção
if (file_exists($maintenance = __DIR__.'/../dados/laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoloader do Composer
require __DIR__.'/../dados/laravel/vendor/autoload.php';

// Bootstrap do Laravel
/** @var Application $app */
$app = require_once __DIR__.'/../dados/laravel/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

> **⚠️ Atenção aos caminhos:** `__DIR__.'/../dados/laravel/...'` pressupõe que `/-/web/` e `dados/` estão no mesmo nível da raiz FTP. Confirme isso conectando via FTP antes de fazer o upload.

---

## 6. Arquivo web.config (IIS) na Pasta Pública

Substitua o conteúdo de `/-/web/web.config` por:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<configuration>
    <system.webServer>

        <!-- Documento padrão -->
        <defaultDocument>
            <files>
                <clear />
                <add value="index.php" />
            </files>
        </defaultDocument>

        <rewrite>
            <rules>
                <!-- Redirecionar HTTP para HTTPS -->
                <rule name="Redirect to HTTPS" stopProcessing="true">
                    <match url="(.*)" />
                    <conditions logicalGrouping="MatchAll" trackAllCaptures="false">
                        <add input="{HTTPS}" pattern="^OFF$" />
                        <add input="{HTTP_HOST}" pattern="^localhost" negate="true" />
                    </conditions>
                    <action type="Redirect" url="https://{HTTP_HOST}/{R:1}" redirectType="Permanent" />
                </rule>

                <!-- Enviar todas as requisições para o index.php do Laravel -->
                <rule name="Laravel URL Rewrite" stopProcessing="true">
                    <match url="^" ignoreCase="false" />
                    <conditions logicalGrouping="MatchAll">
                        <add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
                        <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
                    </conditions>
                    <action type="Rewrite" url="index.php" />
                </rule>
            </rules>
        </rewrite>

        <!-- Segurança: bloquear acesso a arquivos sensíveis -->
        <security>
            <requestFiltering>
                <requestLimits maxAllowedContentLength="67108864" />
                <hiddenSegments>
                    <add segment=".env" />
                    <add segment="web.config" />
                </hiddenSegments>
            </requestFiltering>
        </security>

        <!-- Durante o diagnóstico: Detailed. Em produção: DetailedLocalOnly -->
        <httpErrors errorMode="Detailed" />

    </system.webServer>
</configuration>
```

> **Após confirmar que o site funciona**, altere `errorMode="Detailed"` para `errorMode="DetailedLocalOnly"`.

---

## 7. Configuração do .env de Produção

Crie o arquivo `.env` em `dados/laravel/.env` diretamente pelo **Gerenciador de Arquivos do Painel Locaweb** (opção "Novo Arquivo") ou envie via FTP. **Nunca suba o `.env` local para o servidor.**

```env
APP_NAME="IOA Natal"
APP_ENV=production
APP_KEY=base64:tY/vlA5qePN6MJYNG9uPvFQKXS93YouydSstmgc29qY=
APP_DEBUG=false
APP_URL=https://ioanatal.com.br

APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=ioanatal.mysql.dbaas.com.br
DB_PORT=3306
DB_DATABASE=nome_do_banco_locaweb
DB_USERNAME=usuario_locaweb
DB_PASSWORD=senha_do_banco

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

CACHE_STORE=file

MAIL_MAILER=smtp
MAIL_HOST=email-ssl.com.br
MAIL_PORT=465
MAIL_USERNAME=contato@ioanatal.com.br
MAIL_PASSWORD=senha_do_email
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=contato@ioanatal.com.br
MAIL_FROM_NAME="IOA Natal"
```

> **⚠️ Notas críticas:**
> - `DB_HOST` **nunca é `localhost`** na Locaweb — use o hostname exibido na aba Banco de Dados do painel.
> - `SESSION_DRIVER=file` e `CACHE_STORE=file` evitam dependência das migrations no primeiro boot.
> - Ative `APP_DEBUG=true` temporariamente para diagnóstico e **reverta para `false`** em produção.

---

## 8. Versão do PHP e Extensões no Painel

1. Acesse [painel.locaweb.com.br](https://painel.locaweb.com.br).
2. Vá em **Hospedagem de Sites** → selecione o plano.
3. Localize **Versão do PHP** → defina para **PHP 8.2** ou **PHP 8.3**.
4. Confirme que as extensões estão ativas:

| Extensão | Obrigatória |
|:---|:---|
| `pdo_mysql` | ✅ Sim |
| `mbstring` | ✅ Sim |
| `openssl` | ✅ Sim |
| `curl` | ✅ Sim |
| `fileinfo` | ✅ Sim |
| `xml` | ✅ Sim |
| `tokenizer` | ✅ Sim |
| `ctype` | ✅ Sim |
| `bcmath` | ✅ Sim |
| `gd` ou `imagick` | Recomendado |
| `zip` | Recomendado |

---

## 9. Banco de Dados MySQL na Locaweb

> **⚠️ Na Locaweb compartilhada, `DB_HOST` nunca é `localhost` nem `127.0.0.1`.**

### 9.1 Criar o banco de dados

1. No painel Locaweb → **Bancos de Dados** (MySQL) → **Criar Banco de Dados**.
2. Defina nome e senha segura.
3. Anote com precisão:

| Campo `.env` | Exemplo |
|:---|:---|
| `DB_HOST` | `ioanatal.mysql.dbaas.com.br` |
| `DB_DATABASE` | `ioanatal_db` |
| `DB_USERNAME` | `ioanatal_user` |
| `DB_PASSWORD` | *(a senha definida)* |
| `DB_PORT` | `3306` |

### 9.2 Testar a conexão

Use o link **phpMyAdmin** disponível no painel Locaweb para validar o acesso antes de configurar o `.env`.

---

## 10. Permissões de Escrita (storage e cache)

As pastas abaixo precisam ter permissão de **escrita** para o processo do IIS:

- `dados/laravel/storage/` (e **todas** as subpastas)
- `dados/laravel/bootstrap/cache/`

### Via Gerenciador de Arquivos do Painel Locaweb:

1. Navegue até `dados/laravel/storage/`.
2. Selecione a pasta → **Permissões** (ou **Propriedades**).
3. Marque **Leitura e Gravação** para o usuário do servidor web (`IIS_IUSRS` ou `NETWORK SERVICE`).
4. Aplique de forma **recursiva** (incluir subpastas).
5. Repita o processo para `dados/laravel/bootstrap/cache/`.

> Se o painel não oferecer controle de permissões, abra um chamado no **suporte da Locaweb** solicitando permissão de escrita nas pastas `dados/laravel/storage/` e `dados/laravel/bootstrap/cache/`.

---

## 11. Migrations, Seeders e Otimizações (sem SSH)

Sem acesso SSH, o método é usar uma **rota temporária de setup** que executa os comandos Artisan via requisição HTTP.

### 11.1 Adicionar a rota temporária

No arquivo `dados/laravel/routes/web.php` (edite via FTP ou Gerenciador de Arquivos), adicione ao final:

```php
Route::get('/setup-ioa-xyz-2024', function () {
    Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $migrate = Illuminate\Support\Facades\Artisan::output();

    Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    $seed = Illuminate\Support\Facades\Artisan::output();

    Illuminate\Support\Facades\Artisan::call('optimize:clear');
    Illuminate\Support\Facades\Artisan::call('optimize');

    return response('<pre style="background:#111;color:#0f0;padding:20px;font-family:monospace">' .
        "=== MIGRATIONS ===\n" . htmlspecialchars($migrate) . "\n\n" .
        "=== SEEDERS ===\n" . htmlspecialchars($seed) . "\n\n" .
        "SETUP CONCLUÍDO COM SUCESSO!" .
        '</pre>');
});
```

### 11.2 Executar

Acesse no navegador:
```
https://ioanatal.com.br/setup-ioa-xyz-2024
```

### 11.3 Remover a rota imediatamente

> **🔒 OBRIGATÓRIO:** Assim que ver "SETUP CONCLUÍDO COM SUCESSO!", **remova essa rota** do `routes/web.php` via FTP. É uma falha de segurança crítica se permanecer ativa.

### 11.4 Alternativa: phpMyAdmin (importar SQL direto)

Se preferir não usar a rota de setup:

1. Exporte o banco de dados local como `.sql` (via phpMyAdmin local, TablePlus, DBeaver, etc.).
2. Acesse o **phpMyAdmin** da Locaweb (link disponível no painel).
3. Selecione o banco criado → **Importar** → selecione o arquivo `.sql`.

---

## 12. SSL (HTTPS Gratuito)

1. No Painel Locaweb → **Certificados / SSL**.
2. Selecione o domínio `ioanatal.com.br`.
3. Solicite a emissão do **Let's Encrypt** (gratuito, renovação automática).
4. O `web.config` da [Seção 6](#6-arquivo-webconfig-iis-na-pasta-pública) já inclui o redirecionamento HTTP → HTTPS automaticamente.

---

## 13. E-mail SMTP Locaweb

1. No Painel Locaweb, crie a caixa postal `contato@ioanatal.com.br`.
2. Configure o `.env` com:

| Opção | Servidor SMTP | Porta | Criptografia |
|:---|:---|:---|:---|
| **SSL (recomendado)** | `email-ssl.com.br` | `465` | `ssl` |
| **TLS alternativo** | `smtp.locaweb.com.br` | `587` | `tls` |

---

## 14. Agendador de Tarefas (Scheduled Tasks IIS)

O Laravel Scheduler (`schedule:run`) precisa ser disparado periodicamente. Sem SSH, há duas opções:

### Opção A — Agendador de Tarefas do Painel Locaweb (se disponível)

Verifique no painel se há uma opção de **Cron / Agendador de Tarefas**:

- **Frequência:** a cada 1 minuto (ou o mínimo suportado pelo plano)
- **Comando:** `php C:\caminho\absoluto\dados\laravel\artisan schedule:run`

> Consulte o suporte Locaweb para obter o caminho absoluto correto no Windows Server.

### Opção B — Rota protegida por token (via requisição HTTP)

Adicione em `routes/web.php`:

```php
Route::get('/cron/run', function () {
    if (request('token') !== env('CRON_TOKEN')) {
        abort(403, 'Acesso negado.');
    }
    Illuminate\Support\Facades\Artisan::call('schedule:run');
    return 'schedule:run executado em ' . now();
});
```

No `.env`, adicione:

```env
CRON_TOKEN=seu_token_aleatorio_seguro_aqui
```

Dispare a URL periodicamente via serviço externo de cron (ex: [cron-job.org](https://cron-job.org) — gratuito):

```
https://ioanatal.com.br/cron/run?token=seu_token_aleatorio_seguro_aqui
```

---

## 15. Checklist Pós-Deploy

- [ ] **Site abre sem erro 500** — `ioanatal.com.br` carrega a home page
- [ ] **HTTPS ativo** — cadeado verde no navegador
- [ ] **Home page** — banner hero, depoimentos e dados institucionais exibidos
- [ ] **Cursos e turmas** — listagem e detalhes funcionando
- [ ] **Navegação interna** — nenhuma rota retorna 404
- [ ] **Uploads e imagens** — imagens carregando corretamente
- [ ] **Formulário de contato** — mensagem salva no banco e enviada por e-mail
- [ ] **Painel admin** — acesso em `ioanatal.com.br/admin/login` funcionando
- [ ] **Sitemap** — `ioanatal.com.br/sitemap.xml` retorna XML válido
- [ ] **Rota de setup removida** — `/setup-ioa-xyz-2024` retorna 404
- [ ] **APP_DEBUG=false** — erros PHP não expostos ao público
- [ ] **errorMode="DetailedLocalOnly"** — web.config revertido

### Credenciais iniciais do painel admin

| Campo | Valor |
|:---|:---|
| **URL** | `https://ioanatal.com.br/admin/login` |
| **E-mail** | `admin@ioanatal.com.br` |
| **Senha padrão** | `admin123456` |

> **🔒 Altere a senha imediatamente após o primeiro acesso.**

---

## 16. Deploy de Atualizações Futuras

### 16.1 Preparação local

```powershell
npm run build
composer install --no-dev --optimize-autoloader
```

### 16.2 Envio via FTP (apenas arquivos alterados)

| Se alterou... | Envie para (FTP) |
|:---|:---|
| Views / Blade | `dados/laravel/resources/views/` |
| Controllers / Models | `dados/laravel/app/` |
| Rotas | `dados/laravel/routes/` |
| Migrations novas | `dados/laravel/database/migrations/` |
| CSS / JS (Vite) | `/-/web/build/` (pasta inteira) |
| Configurações | `dados/laravel/config/` |

### 16.3 Limpeza de cache após atualização

Adicione temporariamente em `routes/web.php` e acesse via navegador:

```php
Route::get('/cache-clear-xyz', function () {
    Illuminate\Support\Facades\Artisan::call('optimize:clear');
    Illuminate\Support\Facades\Artisan::call('optimize');
    return 'Cache limpo: ' . now();
});
```

> Remova a rota imediatamente após executar.

---

## 17. Troubleshooting Rápido

### Erro 500.19 no IIS

- **Causa:** Sintaxe inválida no `web.config` ou módulo URL Rewrite ausente no IIS.
- **Solução:** Use exatamente o `web.config` da [Seção 6](#6-arquivo-webconfig-iis-na-pasta-pública). Se persistir, contate o suporte Locaweb pedindo confirmação de que o módulo **URL Rewrite** está instalado no IIS.

### Página em branco (sem mensagem de erro)

- **Causa:** `APP_DEBUG=false` ocultando a exceção PHP.
- **Solução:** Sete temporariamente `APP_DEBUG=true` no `.env` e verifique `dados/laravel/storage/logs/laravel.log` pelo Gerenciador de Arquivos do painel.

### Erro 404 em rotas internas do Laravel

- **Causa:** `web.config` ausente ou fora do lugar.
- **Solução:** Confirme que o `web.config` está na **raiz** de `/-/web/` (não em subpasta).

### Erro de conexão com MySQL

- **Causa:** `DB_HOST=localhost` ou `DB_HOST=127.0.0.1` — inválido na Locaweb.
- **Solução:** Use o hostname exibido na aba **Banco de Dados** do painel (ex: `ioanatal.mysql.dbaas.com.br`).

### Erro de permissão em `storage/logs/`

- **Causa:** Processo IIS sem permissão de escrita na pasta `storage/`.
- **Solução:** Aplique permissão de gravação via [Seção 10](#10-permissões-de-escrita-storage-e-cache) ou abra chamado no suporte Locaweb.

### `index.php` retorna erro de `require` / arquivo não encontrado

- **Causa:** Caminhos ainda apontando para `../vendor/` (estrutura local), sem o Laravel em `dados/laravel/`.
- **Solução:** Aplique o `index.php` corrigido da [Seção 5](#5-ajuste-do-indexphp-na-pasta-pública) e verifique se toda a pasta `vendor/` foi enviada para `dados/laravel/vendor/`.

### Upload de arquivos grandes falha (erro 413 ou timeout)

- **Causa:** Limite de upload do IIS ou do PHP atingido.
- **Solução:** Confirme que o `.user.ini` em `/-/web/` contém:
  ```ini
  upload_max_filesize = 64M
  post_max_size = 64M
  memory_limit = 256M
  max_execution_time = 180
  ```
