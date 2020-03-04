Тестовое задание "Реализовать логику на основе интерфейса SimpleQueryBuilderInterface"
============



Перед запуском тестов, нужно выполнить следующие шаги в корне проекта:
-------------
Требуются установленные пакеты: ``` docker docker-compose ```

1. ``` docker volume create --name=sq-composer ```
2. ``` docker-compose run --rm sq-php /bin/bash -c "composer install" ```

Запуск unit тестов:
-------------
``` docker-compose run --rm sq-php /bin/bash -c "./vendor/bin/phpunit --testdox tests" ```


Шаги без запуска docker контейнера:
-------------
1. В корне проекта выполнить ``` composer install ```
2. Запустить unit тесты``` ./vendor/bin/phpunit --testdox tests ```
