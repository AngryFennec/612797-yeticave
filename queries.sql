DELETE FROM bets;
DELETE FROM lots;
DELETE FROM users;
DELETE FROM categories;


INSERT INTO categories (class, cat_name)
VALUES ('boards', 'Доски и лыжи'),
       ('attachment', 'Крепления'),
       ('boots', 'Ботинки'),
       ('clothing', 'Одежда'),
       ('tools', 'Инструменты'),
       ('other', 'Разное');

INSERT INTO users (email, password, init_date, name, avatar, contacts)
VALUES ('aaa@aaa', '12345', '2010-11-23', 'Иван', 'http://1.jpg', 'телефона нет'),
       ('bbb@bbb', 'qwerty', '2012-05-11', 'Сидр', 'http://2.jpg', 'телефона есть');

       INSERT INTO lots (sum, init_date, end_date, name, description, img, bet_step, user_id, category_id, winner_id)
       VALUES (10999, '2018-10-01', '2018-10-05', '2014 Rossignol District Snowboard', 'доска', 'img/lot-1.jpg', 100, 1, 1, NULL),
               (159999, '2018-09-20', '2018-10-15', 'DC Ply Mens 2016/2017 Snowboard', 'доска', 'img/lot-2.jpg', 200, 2, 1, NULL),
               (8000, '2018-09-21', '2018-09-26', 'Крепления Union Contact Pro 2015 года размер L/XL', 'крепления', 'img/lot-3.jpg', 150, 2, 2, 2),
               (10999, '2018-09-30', '2018-10-26', 'Ботинки для сноуборда DC Mutiny Charocal', 'ботинки', 'img/lot-4.jpg', 125, 1, 3, 1),
               (7500, '2018-10-03', '2018-11-11', 'Куртка для сноуборда DC Mutiny Charocal', 'куртка', 'img/lot-5.jpg', 175, 2, 4, NULL),
               (5400, '2018-10-02', '2018-11-20', 'Маска Oakley Canopy', 'маска', 'img/lot-1.jpg', 75, 1, 6, 2);

       INSERT INTO bets (init_date, user_id, lot_id, sum)
       VALUES ('2018-10-02', 2, 4, 12000),
              ('2018-09-23', 1, 2, 160000);

       # получить все категории
       SELECT cat_name from categories;

       # получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену последней ставки, количество ставок, название категории;
       SELECT l.name, l.sum, l.img, c.cat_name,
              (SELECT b.sum FROM bets b WHERE b.lot_id = l.lot_id ORDER BY b.init_date DESC LIMIT 1) AS 'last_bet',
              СOUNT(b.bet_id) AS 'bet_count'
              FROM lots l
              JOIN categories c
              ON l.category_id = c.category_id
              LEFT JOIN bets b
              ON l.lot_id = b.lot_id
              WHERE l.winner_id IS NULL
              GROUP BY l.lot_id
              ORDER BY l.init_date;

       # показать лот по его id. Получите также название категории, к которой принадлежит лот
       SELECT name, sum, img, cat_name  FROM lots l
       JOIN categories c
       ON l.category_id = c.category_id
       WHERE lot_id = 3;

       # обновить название лота по его идентификатору;
       UPDATE lots SET name = "Новый лот"
       WHERE lot_id = 1;

       # получить список самых свежих ставок для лота по его идентификатору;
       SELECT init_date, user_id, sum FROM bets
       WHERE lot_id = 2 ORDER BY init_date DESC LIMIT 3;
