# Sistema de Gestão

Projeto: sistema-gestao

Descrição
---
Aplicação administrativa construída em Laravel + Inertia + Vue 3 (PrimeVue) com TailwindCSS. O objetivo é gerenciar usuários, perfis/roles e permissões com uma UI reativa (Inertia) e componentes do PrimeVue.

Principais tecnologias
---
- PHP 8.x
- Laravel (estrutura do projeto dentro de `app/`)
- Inertia.js + Vue 3
- PrimeVue (componentes UI)
- TailwindCSS
- Vite (dev server)
- pnpm (gerenciamento front-end)
- SQLite (banco de dados por padrão para desenvolvimento)
- Docker + docker-compose (opcional para rodar em container)
- Pest / PHPUnit (testes)

Estrutura importante do repositório
---
- `app/` — código Laravel (Controllers, Services, DTOs, UseCases...)
- `routes/` — rotas (web.php)
- `resources/js/` — frontend com Inertia + Vue + PrimeVue
- `resources/views/` — views blade que bootam o Inertia
- `database/database.sqlite` — arquivo SQLite (se existir)
- `Dockerfile`, `docker-compose.yml` — configuração de container (se presente)

Pré-requisitos (local)
---
- PHP 8.1+ (recomendado 8.2/8.3 conforme seu composer.json)
- Composer
- Node.js 20.19+ (Vite requer Node 20.19+ ou 22.12+)
- pnpm (o repositório tem `pnpm-lock.yaml`)
- SQLite (ou apenas permissões para criar o arquivo `database/database.sqlite`)

Configuração local (passo-a-passo)
---
1. Clone o repositório

   git clone <seu-repositorio.git>
   cd sistema-gestao

2. Copie o .env e gere a APP_KEY

   cp .env.example .env
   composer install
   pnpm install
   php artisan key:generate

3. Configurar SQLite (modo simples)

   touch database/database.sqlite
   // No seu `.env` defina:
   DB_CONNECTION=sqlite
   DB_DATABASE=${PWD}/database/database.sqlite

   php artisan migrate --seed

Observação: se preferir MySQL/Postgres, configure o `.env` corretamente.

Rodando sem Docker (modo desenvolvimento)
---
- Backend (Laravel):

  php artisan serve --host=127.0.0.1 --port=8000

- Frontend (Vite):

  pnpm dev

Depois abra: http://127.0.0.1:8000 (ou conforme `APP_URL`)

Rodando com Docker (recomendado para ambiente isolado)
---
Se o projeto já contém `Dockerfile` e `docker-compose.yml` você pode rodar:

  docker compose up --build

Dicas importantes para o Docker (com base nos logs que você compartilhou):
- Node.js: Vite exige Node 20.19+; se o container usa Node 18, o Vite pode falhar com erro `crypto.hash is not a function`. Atualize a imagem Node no `Dockerfile` para `node:20` ou `node:22`.
- `vendor/autoload.php` ausente: isso significa que o `composer install` não rodou dentro do container ou o volume sobrescreveu a pasta `vendor`. Rode dentro do container:

  docker compose exec app composer install --no-interaction --prefer-dist --optimize-autoloader

- `fatal: detected dubious ownership in repository`: Git detectou dono diferente. Dentro do container rode:

  git config --global --add safe.directory /var/www/html

- Se seu projeto usa um volume que sobrescreve a pasta do container, certifique-se de ter instalado `vendor` localmente ou rode `composer install` após o container ter o código montado.

Sobre o banco de dados dentro do container
---
Se você montar `database/database.sqlite` como volume, o container usará o mesmo arquivo. Caso contrário, o container pode criar um novo arquivo vazio. Recomendações:
- Garanta que `database/database.sqlite` está presente no host antes de subir o container.
- No `.env` defina `DB_CONNECTION=sqlite` e `DB_DATABASE=/var/www/html/database/database.sqlite` (ou o caminho correto dentro do container).

Scripts úteis
---
- Composer: `composer install`, `composer dump-autoload`
- Frontend: `pnpm dev` (dev), `pnpm build` (produção)
- Artisan: `php artisan migrate --seed`, `php artisan tinker`
- Tests: `./vendor/bin/pest` ou `php artisan test`

Problemas comuns e soluções rápidas
---
1) Vite erro `crypto.hash is not a function` + Node 18
- Atualize Node para 20+ (local ou no Dockerfile/devcontainer).

2) `vendor/autoload.php` não encontrado
- Rode `composer install` dentro do container ou no host e veja se os volumes sobrescrevem `vendor`.

3) Mudanças não refletem no container (ou `dd()` não aparece)
- Possíveis causas:
  - O container executa código a partir de outro diretório (verifique `WORKDIR` no `Dockerfile`).
  - O processo rodando no container não foi reiniciado. Suba novamente o container: `docker compose up --build`.
  - Você montou um volume e o `vendor` ou outro diretório foi sobrescrito — rode `composer install` no container.

4) Git `dubious ownership`
- Rode dentro do container: `git config --global --add safe.directory /var/www/html`

Uso do PrimeVue / ícones
---
Se os ícones dos botões do PrimeVue não aparecem, verifique:
- `primeicons` está instalado: `pnpm add primeicons` (ou checar `package.json`)
- O CSS de `primeicons` está importado no seu entrypoint (ex.: `import 'primeicons/primeicons.css'`)
- Está registrando corretamente o `Button` e passando a prop `icon` (ex.: `icon="pi pi-pencil"`).

Validações e cadastro de usuários
---
- Padrão para confirmação de senha em Laravel (quando usar o campo `password`): use `confirmed` no campo `password` e `password_confirmation` no form. No FormRequest exemplo:

  'password' => 'nullable|string|min:8|confirmed',
  // O campo `password_confirmation` não precisa da regra `required_with` se você usa `confirmed` e quer que a confirmação seja obrigatória *apenas* quando `password` for preenchido. Use:
  'password_confirmation' => 'nullable|string|min:8',

- Para checar `unique` no update, use: `unique:users,email,{id}`. Exemplo completo:

  'email' => 'required|string|email|max:255|unique:users,email,' . $id,

Controle de qualidade (checagens rápidas)
---
- Verifique Node.js localmente: `node -v`
- Verifique Composer: `composer -V`
- Verifique pnpm: `pnpm -v`

Comandos rápidos (resumo)
---
- Instalação:

  composer install
  pnpm install
  cp .env.example .env
  php artisan key:generate
  touch database/database.sqlite
  php artisan migrate --seed

- Rodar local:

  php artisan serve
  pnpm dev

- Rodar com Docker:

  docker compose up --build

Contribuindo
---
1. Faça um fork
2. Crie uma branch com uma feature/bugfix
3. Abra PR explicando mudanças e como testar


Contato
---
Para dúvidas ou ajuda, deixe uma issue no repositório ou entre em contato pelo canal que preferir.

---
