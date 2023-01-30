<?php
include_once ('helpers.php');
session_start();

define('CACHE_DIR', basename(__DIR__ . DIRECTORY_SEPARATOR . 'cache'));
define('UPLOAD_PATH', basename(__DIR__ . DIRECTORY_SEPARATOR . 'uploads'));
$tpl_data = [];

$con = mysqli_connect("127.0.0.1", "root", "", "doingsdone");
mysqli_set_charset($con, "utf8");

$categories = [];
$content = '';

if ($_SERVER['REQUEST_METHOD' == 'POST']) {
    $form = $_POST;
    $errors = [];

    $red_fields = ['email', 'password', 'name'];
    foreach ($red_fields as $field) {
        if (empty($form[$field])) {
            $errors[] = 'Поле не заполнено' . $field;
        }
    }
    if (empty($errors)) {
        $email = mysqli_real_escape_string($con, $form['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            $errors[] = 'Пользователь с этим email уже зарегистрирован';
        } else {
            $password = password_hash($form['password'], PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (dt_create, email, name, password) VALUES (NOW(), ?, ?, ?)';
            $stmt = db_get_prepare_stmt($con, $sql, [$form['email'], $form['name'], $password]);
            $res = mysqli_stmt_execute($stmt);
        }
        if ($res && empty($errors)) {
            header("Location: /");
            exit();
        }
    }
    $tpl_data['errors'] = $errors;
    $tpl_data['values'] = $form;
}
$page_content = include_template('main.php', $tpl_data);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => [],
    'title' => 'GifTube | Регистрация'
]);

print($layout_content);
