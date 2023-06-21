FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
WORKDIR /var/www
COPY . /var/www
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-scripts --no-suggest
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage
RUN apt update \
    # Add PHP 8.1 repository 
    && apt install -y software-properties-common && add-apt-repository ppa:ondrej/php \  
    # PHP extensions
    && apt install -y \  
    php8.1-bcmath \
    php8.1-cli \
    php8.1-curl \
    php8.1-fpm \
    php8.1-gd \
    php8.1-mbstring  \ 
    php8.1-mysql \  
    php8.1-redis \  
    php8.1-sockets \  
    php8.1-sqlite3 \  
    php8.1-pcov \
    php8.1-pgsql \
    php8.1-opcache \
    php8.1-xml \ 
    php8.1-zip \ 
    # Extra
    curl \
    git \
    htop \
    nano \
    nginx \
    supervisor \
    unzip \
    zsh
# Set environment variables
ENV WWWUSER=sail \
    WWWGROUP=sail

EXPOSE 80 8000 8001
CMD ["php-fpm"]


