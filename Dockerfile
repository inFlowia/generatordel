# при смене образа, проверь, актуально ли для него значение PHP_INI_DIR из .env
# в этой директории должны бть php.ini-production и php.ini-development
FROM php:8.3.12-zts-bullseye

# Установка необходимых пакетов и расширений
RUN docker-php-ext-install pdo_mysql