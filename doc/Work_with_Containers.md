# Работа с контейнерами проекта

Внимание! Все команды выполняются **из каталога проекта**, а не из его подкаталога bin.
## Запустить все контейнеры проекта
```bash
bin/up_containers.sh
```

## Остановить все контейнеры проекта
Будут остановлены и удалены все контейнеры и сети, определённые в docker-compose.yaml, а так же сеть по умолчанию
```bash
bin/down_containers.sh
```