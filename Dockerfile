FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    git \
    unzip \
    curl \
    nodejs \
    npm \
    neovim

RUN addgroup -g 1000 appuser && \
    adduser -D -u 1000 -G appuser -s /bin/sh appuser

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN chown -R appuser:appuser /var/www/html

USER appuser

RUN git clone --depth 1 https://github.com/AstroNvim/template ~/.config/nvim
RUN rm -rf ~/.config/nvim/.git
RUN git clone https://github.com/Chivirda/nvim-config.git /tmp/nvim-config
RUN cp -r /tmp/nvim-config/* ~/.config/nvim/lua/plugins/
RUN rm -rf /tmp/nvim-config
