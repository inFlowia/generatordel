# После правок этого файла не забудь выполнить:
# docker-compose build

FROM php:8.3.12-zts-bullseye

# Установка необходимых пакетов и расширений
RUN docker-php-ext-install pdo_mysql

# Версию xdebug лучше указывать явно, так как pecl не проверяет расширение на
# совместимость с версией php (со слов хозяина образа php).
# Совместимость версий xdebug: https://xdebug.org/docs/compat
#
# Есои не выполняется docker-php-ext-enable xdebug, возможно ошибка в
# config/containers/php/xdebug.ini
RUN pecl install xdebug-3.4.1 \
    && docker-php-ext-enable xdebug