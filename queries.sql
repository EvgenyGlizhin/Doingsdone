/*Добавление пользователей*/
INSERT INTO users SET email = 'evgenyglizhin@gmail.com', name = 'Евгений' , password = '144000';
INSERT INTO users SET email = 'evgenyguitarskils@gmail.com', name = 'Женя', password = '1914';
/*Добавление проектов*/
INSERT INTO project SET title = 'Входящие', user_id = '1';
INSERT INTO project SET title = 'Учеба', user_id = '1';
INSERT INTO project SET title = 'Работа', user_id = '1';
INSERT INTO project SET title = 'Домашние дела', user_id = '2';
INSERT INTO project SET title = 'Авто', user_id = '2';
/*Добавление списка задач*/
INSERT INTO tasks SET status = '0', title = 'Собеседование в IT компании', dt_compleat = '2023.03.12', id_user = '1', id_project = '3';
INSERT INTO tasks SET status = '0', title = 'Выполнить тестовое задание', dt_compleat = '2023.12.25', id_user = '1', id_project = '3';
INSERT INTO tasks SET status = '1', title = 'Сделать задание первого раздела', dt_compleat = '2023.12.21', id_user = '1', id_project = '2';
INSERT INTO tasks SET status = '0', title = 'Заказать пиццу', dt_compleat = null, id_user = '2', id_project = '4';
INSERT INTO tasks SET status = '0', title = 'Встреча с другом', dt_compleat = '2019.12.22', id_user = '1', id_project = '1';
INSERT INTO tasks SET status = '0', title = 'Купить корм для кота', dt_compleat = null, id_user = '2', id_project = '4';
/*Тестовые запросы на чтение и обновление*/
SELECT title FROM project WHERE user_id = '1';
SELECT title FROM tasks WHERE id_project = '3';
UPDATE tasks SET status = '1' WHERE title = 'Собеседование в IT компании';
UPDATE tasks SET title = 'Сделать задание 4 раздела' WHERE id = 3;  





 