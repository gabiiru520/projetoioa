# Guia de Deploy — IOA Natal no Locaweb Hospedagem I

> **Stack:** Laravel 11 + PHP 8.2 + SQLite (dev) / MySQL (produção) + Blade + Tailwind CSS (Vite) + Alpine.js

---

## 1. Pré-requisitos (validar antes de fazer deploy)

Antes de enviar os arquivos, acesse o servidor via SSH e valide:

```bash
# Confirmar versão do PHP (deve ser >= 8.2)
php -v

# Verificar quais funções estão desabilitadas
php -i | grep disable_functions

# Verificar extensões disponíveis
php -m | grep -E "pdo|mbstring|openssl|tokenizer|json|curl|fileinfo|xml|gd"
```

Extensões **obrigatórias** para o Laravel 11:
- `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `json`, `xml`, `fileinfo`, `bcmath`

---

## 2. Estrutura de diretórios no servidor Locaweb

A Locaweb Hospedagem I tem o document root fixo em `public_html`. O Laravel coloca arquivos públicos em `public/`. A solução é:

```
/home/USUARIO/
├── public_html/          ← document root (conteúdo da pasta public/ do Laravel)
│   ├── .htaccess
│   ├── index.php         ← ajustado para apontar para ../laravel/bootstrap/app.php
│   ├── build/            ← assets compilados pelo Vite
│   ├── images/
│   ├── sitemap.xml
│   └── favicon.svg
│
└── laravel/              ← raiz do projeto Laravel (fora do public_html)
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    └── .env
```

---

## 3. Passos do Deploy

### 3.1 Compilar assets localmente

```bash
# Na sua máquina local, dentro da pasta do projeto
npm run build
```

Isso gera a pasta `public/build/` com os CSS e JS otimizados.

### 3.2 Instalar dependências PHP localmente

```bash
composer install --no-dev --optimize-autoloader
```

### 3.3 Enviar arquivos via SFTP/SSH

Use um cliente SFTP (FileZilla, Cyberduck, WinSCP, etc.) para enviar:

1. **Toda a pasta do projeto** (exceto `node_modules`, `.git`, `database/database.sqlite`) para `~/laravel/`
2. **Conteúdo de `public/`** para `~/public_html/`

> ⚠️ **Não envie** `node_modules/` — é desnecessário em produção.

### 3.4 Ajustar o `index.php` em `public_html/`

Edite `~/public_html/index.php` e ajuste os caminhos `require`:

```php
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode check
if (file_exists($maintenance = __DIR__.'/../laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader.
require __DIR__.'/../laravel/vendor/autoload.php';

// Bootstrap Laravel and handle the request.
(require_once __DIR__.'/../laravel/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

### 3.5 Configurar o arquivo `.env` em produção

Edite `~/laravel/.env` com as credenciais reais:

```env
APP_NAME="IOA Natal"
APP_ENV=production
APP_KEY=         # Gerar: php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://www.ioanatal.com.br

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nome_do_banco_mysql
DB_USERNAME=usuario_mysql
DB_PASSWORD=senha_mysql

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.locaweb.com.br
MAIL_PORT=587
MAIL_USERNAME=contato@ioanatal.com.br
MAIL_PASSWORD=senha_do_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contato@ioanatal.com.br
MAIL_FROM_NAME="IOA Natal"
```

### 3.6 Gerar APP_KEY

```bash
cd ~/laravel
php artisan key:generate
```

### 3.7 Configurar permissões de diretórios

```bash
chmod -R 775 ~/laravel/storage
chmod -R 775 ~/laravel/bootstrap/cache
```

### 3.8 Executar migrations e seeders

```bash
cd ~/laravel
php artisan migrate --force
php artisan db:seed --force
```

### 3.9 Otimizar o Laravel para produção

```bash
cd ~/laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 3.10 Gerar sitemap.xml

```bash
cd ~/laravel
php artisan sitemap:generate
```

---

## 4. Storage / Upload de Arquivos (Fallback para ambientes sem symlink)

O Hospedagem I pode ter `symlink()` desabilitado. O projeto já inclui uma solução de fallback via `MediaController`:

- Arquivos são enviados para `storage/app/public/uploads/`
- São servidos via a rota `/media/{path}` que faz streaming dos arquivos
- **NÃO é necessário** executar `php artisan storage:link`

> Se o servidor permitir symlinks: `php artisan storage:link` pode ser usado como alternativa mais eficiente.

---

## 5. Configurar Cron Job no Locaweb

No painel da Locaweb, acesse **Agendamento de Tarefas (Cron Jobs)** e adicione:

```
* * * * * /usr/local/bin/php ~/laravel/artisan schedule:run >> /dev/null 2>&1
```

Isso habilita:
- ✅ Publicação automática de posts agendados no Blog
- ✅ Geração diária do `sitemap.xml`

> Ajuste o caminho do PHP conforme a versão instalada no servidor (use `which php` via SSH para confirmar).

---

## 6. Configurar .htaccess em `public_html/`

O arquivo `public/.htaccess` gerado pelo Laravel já é compatível. Verifique se está presente em `~/public_html/.htaccess` com o conteúdo padrão do Laravel:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## 7. Configurar SSL (HTTPS)

No painel da Locaweb:
1. Vá em **Domínios** → selecione seu domínio
2. Ative o **Certificado SSL Let's Encrypt** (gratuito)
3. Aguarde a propagação (até 24h)
4. Configure redirecionamento HTTP → HTTPS no `.htaccess`:

```apache
# Adicionar ANTES das regras de RewriteEngine
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]
```

---

## 8. Informações de Acesso Admin

Após o primeiro deploy e seeder:

| Campo   | Valor                   |
|---------|-------------------------|
| URL     | `/admin/login`          |
| E-mail  | `admin@ioanatal.com.br` |
| Senha   | `admin123456`           |

> ⚠️ **Altere a senha imediatamente** após o primeiro acesso em `/admin/profile`.

---

## 9. Deploy de Atualizações (fluxo contínuo)

Para atualizações futuras:

```bash
# 1. Compilar localmente
npm run build
composer install --no-dev --optimize-autoloader

# 2. Enviar via SFTP os arquivos alterados

# 3. No servidor (via SSH):
cd ~/laravel
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan sitemap:generate
```

---

## 10. Validação pós-deploy

Após o deploy, verifique:

- [ ] Página inicial carrega corretamente
- [ ] Cursos e Turmas listam dados
- [ ] Portfólio e Blog funcionam
- [ ] Formulário de contato envia (gravar no banco)
- [ ] Admin login funciona (`/admin/login`)
- [ ] Upload de imagem funciona no admin
- [ ] HTTPS está ativo e funcionando
- [ ] `https://seudominio.com.br/sitemap.xml` retorna XML válido
- [ ] Botão WhatsApp abre corretamente com número configurado
