# Решение распространённых проблем

## Ошибка при docker-compose up
```
ERROR: for db  'ContainerConfig'
Traceback (most recent call last):
  File "docker-compose", line 3, in <module>
  File "compose/cli/main.py", line 81, in main
  File "compose/cli/main.py", line 203, in perform_command
  File "compose/metrics/decorator.py", line 18, in wrapper
  File "compose/cli/main.py", line 1186, in up
  File "compose/cli/main.py", line 1182, in up
  File "compose/project.py", line 702, in up
  File "compose/parallel.py", line 108, in parallel_execute
  File "compose/parallel.py", line 206, in producer
  File "compose/project.py", line 688, in do
  File "compose/service.py", line 581, in execute_convergence_plan
  File "compose/service.py", line 503, in _execute_convergence_recreate
  File "compose/parallel.py", line 108, in parallel_execute
  File "compose/parallel.py", line 206, in producer
  File "compose/service.py", line 496, in recreate
  File "compose/service.py", line 615, in recreate_container
  File "compose/service.py", line 334, in create_container
  File "compose/service.py", line 922, in _get_container_create_options
  File "compose/service.py", line 962, in _build_container_volume_options
  File "compose/service.py", line 1549, in merge_volume_bindings
  File "compose/service.py", line 1579, in get_container_data_volumes
KeyError: 'ContainerConfig'
[13617] Failed to execute script docker-compose
```

### Варианты решений

#### А. Если остановка всех контейнеров допустима
```bash
docker-compose down
```

#### Б. Если имя или часть имени проблемного контейнера известна и она не является частью имени другого контейнера
например это gendel_container_db
```bash
 docker rm `docker ps --format 'table {{.Names}}' --no-trunc -a | grep gendel_container_db`
```

#### В. Если проблемный контейнер неизвестен
```bash
docker ps --format 'table {{.Names}}' --no-trunc -a | grep gendel
```
Найти контейнер у которого вместо имени из container_name имя с буквенно числовым префиксом вида: `f4dc18a27c9e_some_actual_container_name` и удалить его:
```bash
docker rm f4dc18a27c9e_gendel_container_db
```

## Значение переменной окружения не переопределяется
Если проблемное значение переменной задано в локальном файле, то убедитесь, что в имени файла указано окружение, то есть это например  
.env.test.local  
а не  
.env.local  
В данном проекте .env.local не используется. `bin/console debug:dotenv` его не видит. Используйте локальный файл с указанием окружения в имени.

## Ошибка подключения к БД: "Temporary failure in name resolution"
### Проблема:
при любой операции с БД, например при `doctrine:migrations:status` случается ошибка:
```bash
In ExceptionConverter.php line 101:
                                                                                                                                                                     
  An exception occurred in the driver: SQLSTATE[HY000] [2002] php_network_getaddresses: getaddrinfo for gendel_db_host failed: Temporary failure in name resolution  
                                                                                                                                                                     

In Exception.php line 28:
                                                                                                                                
  SQLSTATE[HY000] [2002] php_network_getaddresses: getaddrinfo for gendel_db_host failed: Temporary failure in name resolution  
                                                                                                                                

In Driver.php line 33:
                                                                                                                                
  SQLSTATE[HY000] [2002] php_network_getaddresses: getaddrinfo for gendel_db_host failed: Temporary failure in name resolution  
                                                                                                                                

In Driver.php line 33:
                                                                                                                             
  PDO::__construct(): php_network_getaddresses: getaddrinfo for gendel_db_host failed: Temporary failure in name resolution
```
и при этом `docker ps` в столбце NAMES показывает имена **сервисов**, а не имена контейнеров. Кроме того к имени сервиса добавлен числовой суффикс "_1". То есть ответ такой:
```bash
docker ps
CONTAINER ID   IMAGE                             COMMAND                  CREATED        STATUS          PORTS                                                            NAMES
4409bb26f625   generatordel_gendel_service_php   "docker-php-entrypoi…"   23 hours ago   Up 39 seconds                                                                    generatordel_gendel_service_php_1
4fa4784bab7a   mysql:8.0.39-debian               "docker-entrypoint.s…"   23 hours ago   Up 58 minutes   3306/tcp, 33060/tcp, 0.0.0.0:3306->3307/tcp, :::3306->3307/tcp   generatordel_gendel_service_db_1
```
В то время как ожидался такой:
```bash
docker ps
CONTAINER ID   IMAGE                             COMMAND                  CREATED              STATUS              PORTS                                                            NAMES
ad114df158dd   generatordel_gendel_service_php   "docker-php-entrypoi…"   About a minute ago   Up About a minute                                                                    gendel_container_php
c26d4025356c   mysql:8.0.39-debian               "docker-entrypoint.s…"   About a minute ago   Up About a minute   3306/tcp, 33060/tcp, 0.0.0.0:3306->3307/tcp, :::3306->3307/tcp   gendel_container_db
```
### Решение:
Скорее всего контейнеры были запущены при помощи команды `./up_containers.sh`, выполненной из каталога bin, а не из корневого каталога проекта. Если это так, то выполните
```bash
./down_containers.sh
cd ..
bin/up_containers.sh
```
## Не устанавливается пакет, ругается на уязвимости, но очень хочется
Временно удали:
`roave/security-advisories`
Это вручную установленный не обязательный пакет.