# Modern MVC app (Geekbrains PHP 2)

Принцип работы

- Создаем приложение Application (singleton)
- Создаем объект Request и регистрируем в Application
- Создаем объект Router (с параметрами из Request) и регистрируем в Application
- Инициализируем маршрут и ищем Controller
- Создаем Controller, передаем ему Request (в конструкторе)
- Вызываем action у Controller
- При необходимости подключаем Model или ActiveRecord (DBAL)
- При необходимости подключаем View (оболочка для Twig)
- Вызываем в action у Controller возврат view() или json()
- Полученный результат вернется в Application
- Application отдает результат пользователю