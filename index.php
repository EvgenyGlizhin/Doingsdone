<?php
include_once('helpers.php');


/*Фукция подщёта задач относящихся к проекту*/
function countTaskFromProject($progect_array, $task_array)
{
    $number = 0;
    foreach ($task_array as $one_task) {
        if ($one_task['id_project'] === $progect_array['id']) {
            $number++;
        };
    }
    return $number;
}

;

/*функция даты времени*/
function importantDateRed($dedline)
{
    $dedline_1 = $dedline['dt_compleat'];
    $ts = time();
    $end_ts = strtotime($dedline_1);
    $ts_diff = $end_ts - $ts;
    if ($ts_diff < 86400) {
        return '<tr class="task--important">';
    }
}

;
/* Запросы в базу на получение данных проектов */
$connectDatabase = mysqli_connect("127.0.0.1", "root", "", "doingsdone");
mysqli_set_charset($connectDatabase, "utf8");
$sqlQueryProject = "SELECT id, title, user_id FROM project WHERE user_id = 1 || 2";
$resultQueryProject = mysqli_query($connectDatabase, $sqlQueryProject);
if (!$resultQueryProject) {
    $error = mysqli_error($connectDatabase);
    print("Ошибка MySQL: " . $error);
};
$projects = mysqli_fetch_all($resultQueryProject, MYSQLI_ASSOC);

/* Запросы в базу на получение данных задач */
$sqlQueryTask = "SELECT title, dt_compleat, id_project, file_link, id_user, status FROM tasks WHERE id_user = 1 || 2";
$resultQueryTask = mysqli_query($connectDatabase, $sqlQueryTask);
if (!$resultQueryTask) {
    $error = mysqli_error($connectDatabase);
    print("Ошибка MySQL: " . $error);
};
$tasks = mysqli_fetch_all($resultQueryTask, MYSQLI_ASSOC);

/* Запросы в базу получение данных пользователей */
$sqlQueryUsers = "SELECT id, dt_create, email, password FROM users WHERE id = 1 || 2";
$resultQueryUsers = mysqli_query($connectDatabase, $sqlQueryUsers);
if (!$resultQueryUsers) {
    $error = mysqli_error($connectDatabase);
    print("Ошибка MySQL: " . $error);
}
$users = mysqli_fetch_all($resultQueryTask, MYSQLI_ASSOC);

/* Получение задач относящиеся к проекту */

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlQueryTaskFromProject = "SELECT * FROM tasks WHERE id_project = " . "$id";
    $resultQueryTaskFromProject = mysqli_query($connectDatabase, $sqlQueryTaskFromProject);
    $tasks = mysqli_fetch_all($resultQueryTaskFromProject, MYSQLI_ASSOC);
    $main_content = include_template('main.php', ['projects' => $projects, 'task' => $tasks]);
    $layout_content = include_template('layout.php', ['page_content' => $main_content, 'name_page' => 'Главная']);
}

/* Шаблонизация и показ страниц */

if (isset($_GET['add'])) {
    $main_content = include_template('form_add.php', ['projects' => $projects, 'tasks' => $tasks]);
    $layout_content = include_template('layout.php', ['page_content' => $main_content, 'name_page' => 'Добавление задачи']);
} else {
    $main_content = include_template('main.php', ['projects' => $projects, 'tasks' => $tasks]);
    $layout_content = include_template('layout.php', ['page_content' => $main_content, 'name_page' => 'Главная']);
}

/* Вывод содержимого на странице */
print($layout_content);



