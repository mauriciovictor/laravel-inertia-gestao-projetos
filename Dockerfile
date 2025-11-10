# Dockerfile para ambiente de desenvolvimento Laravel com SQLite
# Imagem base: PHP 8.2 CLI (possui php-cli para rodar `php artisan serve`)
FROM php:8.2-cli

# Evita prompts do apt e define diretório de trabalho
ENV DEBIAN_FRONTEND=noninteractive
WORKDIR /var/www/html

# Instala dependências do sistema necessárias para Laravel + extensões (inclui sqlite)
# Comentários: pacotes como libzip-dev, libpng-dev e libsqlite3-dev são necessários para extensões
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        git \
        curl \
        zip \
        unzip \
        sqlite3 \
        libsqlite3-dev \
        libzip-dev \
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        libxml2-dev \
        procps \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_sqlite mbstring zip exif pcntl gd xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala Composer (usa binário oficial do composer para cache de camada)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala Node.js 20 (via NodeSource) e habilita pnpm via corepack
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && corepack enable \
    && corepack prepare pnpm@8.10.0 --activate \
    && npm install -g up \
    && rm -rf /var/lib/apt/lists/*

# Copia todo o código da aplicação
COPY . .

# Copia apenas os arquivos de manifest para aproveitar cache das camadas
# (composer.json / composer.lock / package.json / pnpm-lock.yaml)
COPY composer.json composer.lock package.json pnpm-lock.yaml* ./

# Instala dependências de PHP e Node — em dev isso deixa as dependências no image layer
# Ainda assim o volume do host sobrescreverá, mas isso melhora builds repetidos.
RUN composer install --no-interaction --prefer-dist --no-progress || true
RUN pnpm install --frozen-lockfile || true

# Garante permissões básicas para storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/html || true
RUN chmod -R 755 /var/www/html/storage || true

# Expõe portas: 8000 para php artisan serve e 5173 para Vite dev server (se usado)
EXPOSE 8000 5173

# Usuário por padrão (pode trocar para root se precisar instalar algo no container)
USER www-data

COPY docker-entrypoint.sh /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
