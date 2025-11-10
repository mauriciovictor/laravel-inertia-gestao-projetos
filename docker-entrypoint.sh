#!/usr/bin/env bash
set -euo pipefail

# Entrypoint para desenvolvimento:
# - garante safe.directory para git (evita "detected dubious ownership")
# - instala dependências PHP/JS quando o volume do host sobrescreve as camadas da imagem
# - cria o arquivo do sqlite se não existir
# - ajusta permissões e executa o comando final (ou `composer run dev` por padrão)

cd /var/www/html || exit 0

# Marca o diretório como safe para o Git (evita mensagens de "dubious ownership")
if [ -d .git ]; then
  git config --global --add safe.directory /var/www/html || true
fi

# Instala dependências PHP se não houver autoload (ou se o vendor estiver ausente)
if [ ! -f vendor/autoload.php ]; then
  echo "[entrypoint] vendor not found — running composer install..."
  # Tenta usar composer estático (instalado na imagem) ou fallback para 'composer' no PATH
  composer install --no-interaction --prefer-dist --optimize-autoloader --no-progress || true
fi

# Instala dependências JS se houver package.json e node_modules ausente
if [ -f package.json ]; then
  if [ ! -d node_modules ]; then
    echo "[entrypoint] node_modules not found — installing JS deps..."
    if command -v pnpm >/dev/null 2>&1; then
      pnpm install --frozen-lockfile || pnpm install || true
    elif command -v npm >/dev/null 2>&1; then
      npm install || true
    fi
  fi
fi

# Garante que o arquivo sqlite exista (se estiver configurado para usar sqlite no .env)
mkdir -p database || true
if [ ! -f database/database.sqlite ]; then
  touch database/database.sqlite || true
  echo "[entrypoint] created database/database.sqlite"
fi

# Ajusta permissões básicas para desenvolvimento
chown -R www-data:www-data /var/www/html || true
chmod -R 755 storage bootstrap/cache || true

# Se o usuário passou comandos ao docker run / compose (ex.: bash), executa-os.
if [ "$#" -gt 0 ]; then
  echo "[entrypoint] running passed command: $*"
  exec "$@"
fi

# Comando padrão (mantém comportamento anterior)
exec composer run dev
