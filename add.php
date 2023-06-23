<?php
include_once('helpers.php');


//Валидиция на заполненость и вывод ошибки

$errors = [];
if (!empty($_POST)) {
    $formArrays = [
        'name',
        'project',
        'date',
    ];
    foreach ($formArrays as $formArray) {

        if (empty($_POST[$formArray])) {
            $errors[$formArray] = 'Поле не заполнено';
        }
    }
}

// Добавление файла задачи в базу если нет ошибок

if (empty($errors)) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['file']['name'])) {
            $file_name = $_FILES['file']['name'];
            $file_path = __DIR__ . '/uploads/';
            $file_url = '/uploads/' . $file_name ?? null;
            move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
        }

        // Добавление данных задачи в базу //

        $name = $_POST['name'];
        $project = $_POST['project'];
        $date = $_POST['date'];
        $status = '0';
        $user = '1';
        $addTask = "INSERT INTO `tasks` (`status`, `title`, `dt_compleat`, `id_user`, `id_project`, `file_link`) VALUES ('$status', '$name', '$date', '$user', '$project','$file_url')";
    }

    // Возврат на главную если успешно

    if (mysqli_query($connectDatabase, $addTask)) {
        redirect('index.php');
    }
}

if (!empty($errors)) {
    $mainContent = include_template('form_add.php', [
        'tasks' => $tasks,
        'projects' => $projects,
        'errors' => $errors,
    ]);

    echo include_template('layout.php', ['name_page' => 'Ошибка заполнения', 'page_content' => $mainContent]);
}



