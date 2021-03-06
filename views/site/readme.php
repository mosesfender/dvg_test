<ol>
    <li>Сделать тестовый проект на Yii Framework 2</li>
    <li>
        Добавить через миграцию таблицу Notice с колонками id (pk), oncreate (timestamp), message (text). Реализовать модель для этой таблицы, 
        <ul>
    <li>message и oncreate обязательные поля и не могут быть пустыми,</li>
    <li>при создании нового элемента значение oncreate должно генерироваться случайно в пределах дат что задаються через файл конфигурации фреймворка (можно просто указывать минимальный и максимальный год).</li>
        </ul>
    </li>
    <li>Сделать главную страницу на которой должны быть следующие элементы (использовать для дизайна готовые стили bootstrap и выджеты фреймворка)
        <ul>
   <li>Зона уведомлений об успешном добавления или удаления записи в БД</li>
   <li>Форма для добавления новой записи в таблицу с одим полем message (text) и кнопкой "Добавить"</li>
   <li>Таблица с записями где для каждого рядка должна быть кнопка "Удалить запись"</li>
   <li>Пагинатор по месяцам (поле oncreate). нужно сделать пагинатор по месяцам где каждая страница показывает записи за отдельно взятый месяц</li>
        </ul>
    </li>
    <li>
        Реализовать весь функционал через три экшены
        <ul>
   <li>actionIndex главная страница</li>
   <li>actionCreate добавления записи</li>
   <li>actionDelete удаления записи (удалять только через POST запрос)</li>
        </ul>
    </li>
    Все запросы к БД нужно реализовать через механизмы фреймворка Active Record, вручную написанный SQL запрос в коде будет считаться минусом
</ol>