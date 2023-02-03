<?php
include_once('helpers.php');


/*Фукция подщёта задач относящихся к проекту*/
function countTaskFromProject($projectArray, $taskArray)
{
    $number = 0;
    foreach ($taskArray as $oneTask) {
        if ($oneTask['id_project'] === $projectArray['id']) {
            $number++;
        };
    }
    return $number;
}

;

/*функция даты времени*/
function importantDateRed($dedLine)
{
    $dedLineDate = $dedLine['dt_compleat'];
    $timestamp = time();
    $endTimestamp = strtotime($dedLineDate);
    $secondToDedLine = $endTimestamp - $timestamp;
    if ($secondToDedLine < 86400) {
        return '<tr class="task--important">';
    }
}

/* Пользователь */

$user = getUserId(1);

/* Получение данных проектов */
$projects = getProjectsForUser($user);

/* Запросы в базу на получение данных задач */

$tasks = getTasksFromUser($user);

/* Получение данных пользователей */



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



