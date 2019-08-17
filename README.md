# Сервис на PHP для генерации случайных значений

Запуск:

Перейти в папку с проектом и выполнить команды:

	$ docker-compose build
	$ docker-compose up -d

Отправлять запросы с помощью cURL:

- Для GET-запросов:

      $ curl -X GET http://127.0.0.1:8080/api/retrieve/8 -i

- Для POST-запросов:

      $ curl -X POST http://127.0.0.1:8080/api/generate/ -i
      $ curl -X POST http://127.0.0.1:8080/api/generate/ --data "type=number&length=6" -i

Аргументы для POST-запроса должны быть прописаны в теле сообщения.

Типы (type) допустимых значений - string (строковый), num (числовой), alphanumeric (цифробуквенный).

Допустимая длина (length) - от 1 до 45
