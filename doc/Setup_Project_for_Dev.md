# Настройка проекта для разработки

Установить докер.

В директории проекта выполнить:
```bash
docker-compose up -d
docker exec -it gendel_composer bash
```
После входа в контейнер gendel_composer
```bash
composer install
```