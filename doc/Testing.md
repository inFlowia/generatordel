# Средства тестирования приложения и проверки готовности проекта для разработки

## Наиболее полная проверка (включает PHPUnit-тесты)
```shell
bin/check_poject.sh
```

## Только PHPUnit-тесты
```shell
bin/test.sh
```
Для запуска отдельного теста, передайте путь к нему относительно директории проекта:
```shell
bin/test.sh 'tests/Controller/UserIdeasComponent/LimitOffsetTest.php'
```
Так же возможна передача целой директории, для запуска всех тестов из неё:
```shell
bin/test.sh 'tests/Controller/UserIdeasComponent'
```
Если причина провала тестов неочевидна, вероятно нужно пересоздать фикстуры. Имейте в виду, что это действие полностью пересоздаст БД тестового окружения:
```bash
bin/recreate_fixtures.sh
```

## Минимальная проверка (не включает PHPUnit-тесты)
```shell
bin/mini-check_project.sh
```