# Настройка проекта для разработки


1. Клонируйте проект к себе в директорию, созданную для этого проекта. Дальнейшие команды выполняются в этой директории.
2. 
    ```bash
    cp .env.test.local.template .env.test.local
    ```
3. Задать в .env.test.local все переменные со значением "changeMe".  

4. Установить докер.
5. 
    ```bash
    bin/setup_project_for_dev.sh
    ```

Если в результате выполнения последней команды вы видите зелёный список фикстур, значит проект готов к работе.

Красное сообщение: "[CAUTION] This operation should not be executed in a production environment!" не свидетельствует об ошибке настройки.

## Примечания
При внесении любых правок в docker-compose.yaml или изменении, некоторых переменных в любых .env-файлах требуется удаление контейнера (`docker-compose rm -svf some_container_name`), иначе при запуске будет ошибка: "Ошибка при docker-compose up" (см. [Troubleshooting](Troubleshooting.md))