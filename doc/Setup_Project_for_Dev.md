# Настройка проекта для разработки

В директории проекта:
```bash
cp .env.test.local.template .env.test.local
```
Задать в нём все переменные со значением "changeMe".  
_Именно .env.test.local а не .env.local, потому что bin/console debug:dotenv не видит .env.local ._

Установить докер.

```bash
docker-compose up -d;\
docker exec -it gendel_composer composer install;\
bin/c
```

Если в результате выполнения последней команды вы видите зелёное сообщение "[OK] Minimal check of application functionality has been success!", значит проект готов к работе.

## Примечания
При внесении любых правок в docker-compose.yaml или изменении, некоторых переменных в любых .env-файлах требуется удаление контейнера (`docker-compose rm -svf some_container_name`), иначе при запуске будет ошибка: "Ошибка при docker-compose up" (см. в Troubleshooting)