# Настройка проекта для разработки

В директории проекта:
```bash
touch .env.local
```
Скопировать в него все незаданные переменные из .env и задать их.

Установить докер.

```bash
docker-compose up -d
docker exec -it gendel_composer composer install
```

## Примечания
При внесении любых правок в docker-compose.yaml или изменении, некоторых переменных в любых .env-файлах требуется удаление контейнера, иначе при запуске будет ошибка: "Ошибка при docker-compose up" (см. в Troubleshooting)