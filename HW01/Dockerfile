# Используем официальный PHP образ
FROM php:8.2-fpm

# Устанавливаем необходимые пакеты и расширения
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo_mysql

# Устанавливаем Composer (если требуется)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Настройка рабочего каталога
WORKDIR /var/www/html
