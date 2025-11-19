# ========= Stage 1: build PHP 8.3 extensions (zip + mongodb) =========
FROM php:8.3-fpm AS pecl_builder
ARG MONGO_PECL_VERSION=1.20.1   # compatible with PHP 8.3

# Build deps - simple approach first
RUN set -eux; \
    apt-get update && \
    apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        unzip \
        vim \
        locales \
        zip \
        libzip-dev \
        pkg-config \
        autoconf \
        g++ \
        make \
        libssl-dev && \
    rm -rf /var/lib/apt/lists/*

# Build PHP extensions
RUN set -eux; \
  docker-php-ext-configure zip; \
  docker-php-ext-install zip; \
  pecl channel-update pecl.php.net; \
  pecl install mongodb-${MONGO_PECL_VERSION}; \
  mkdir -p /build-ext; \
  # PHP 8.3 ABI = 20230831
  cp -v /usr/local/lib/php/extensions/no-debug-non-zts-20230831/zip.so      /build-ext/; \
  cp -v /usr/local/lib/php/extensions/no-debug-non-zts-20230831/mongodb.so /build-ext/

# ========= Stage 2: runtime (Nginx + PHP-FPM 8.3) =========
FROM php:8.3-fpm
ENV DEBIAN_FRONTEND=noninteractive
WORKDIR /usr/share/nginx/html

# Install runtime dependencies
# Note: libzip4 changed to libzip5 in newer Debian versions
RUN set -eux; \
  apt-get update && \
  apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    git \
    unzip \
    vim \
    locales \
    zip \
    libzip5 \
    nginx && \
  rm -rf /var/lib/apt/lists/*

# App & Composer (Composer 2 supports PHP 8.3)
COPY . /usr/share/nginx/html/
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Enable ZIP + MongoDB built above (PHP 8.3 uses docker-php-ext-enable)
COPY --from=pecl_builder /build-ext/zip.so      /usr/local/lib/php/extensions/no-debug-non-zts-20230831/
COPY --from=pecl_builder /build-ext/mongodb.so  /usr/local/lib/php/extensions/no-debug-non-zts-20230831/

# Enable extensions using docker-php-ext-enable (works with official php image)
RUN docker-php-ext-enable zip && \
    echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/docker-php-ext-mongodb.ini

# Laravel (best-effort for build stage)
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress || true \
 && php artisan storage:link || true

# ---- Node from official tarball (no apt/nodesource) ----
# Updated to Node 18 LTS for better compatibility with modern tooling
ENV NODE_VERSION=v18.20.5
RUN set -eux; \
  curl -fsSL https://nodejs.org/dist/${NODE_VERSION}/node-${NODE_VERSION}-linux-x64.tar.gz \
  | tar -xz -C /usr/local --strip-components=1 --no-same-owner; \
  node -v && npm -v

RUN npm install && (npm run prod || npm run build || true)

# Nginx & PHP-FPM configs (official php:8.3-fpm uses /usr/local/etc/php-fpm.d/)
COPY deploy/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY deploy/nginx/nginx.conf   /etc/nginx/nginx.conf
COPY deploy/php-fpm/www.conf   /usr/local/etc/php-fpm.d/www.conf

# Logs to stdout/stderr
RUN ln -sf /dev/stdout /var/log/nginx/app.log \
 && ln -sf /dev/stderr /var/log/nginx/app.error.log

# Expose ports
EXPOSE 80 9000

# Start script to run both nginx and php-fpm
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
