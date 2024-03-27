1. Для корректной работы нужно подключить docker контейнер с БД MySql: docker compose up -d --build
2. Делаем миграции: doctrine:migrations:migrate
3. Заполняем БД тестовыми данными: bin/console doctrine:fixtures:load
4. Запускаем сервер: symfony serve
5. Создание нового автора: /api/author ['POST'] {string firstName, string lastName}
6. Удаление автора: /api/author/{id} ['DELETE'] id = int
7. Создание книги: /api/book ['POST'] {string title, int year, int publisherId, array authorIds}
8. Получить весь список книг /api/book ['GET']
9. Удалить книгу /api/book/{id} ['DELETE'] id = int
10. Добавить издателя /api/publisher ['POST'] {string name, string address}
11. Изменить издателя /api/publisher/{id} ['POST'] id = int {string name, string address}
12. Удалить издателя /api/publisher/{id} ['DELETE'] id = int
13. Команда по удалению всех авторов у которых нет книг: bin/console app:clearAuthor