<?php

require_once "../../components/DB_Connect.php";

$data = $_POST;

if (!isset ($_SESSION['login'])) {
    if (isset($data['addTaskLogin']) && isset($data['addTaskEmail'])) {
        $login = $data['addTaskLogin'];
        $email = $data['addTaskEmail'];
    } else {
        echo "error";
    }
} else {
    $login = $_SESSION['login'];
    $email = $_SESSION['email'];
}

if (isset($data['addTaskText'])) {
    $text = $data['addTaskText'];
} else {
    echo "error";
}


if (isset($_FILES['addTaskImg']) && $_FILES['addTaskImg']['error'] == 0) {
    $dir = '/upload/';
    $arrType = array('image/jpeg', 'image/gif', 'image/png',);
    $arrExt = array('png', 'jpg', 'jpeg', 'gif');
    $ext = pathinfo($_FILES['addTaskImg']['name'], PATHINFO_EXTENSION);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $type = $finfo->file($_FILES['addTaskImg']['tmp_name']);
    if (in_array($type, $arrType) && in_array($ext, $arrExt)) {
        $filepath = $dir . uniqid() . '.' . $ext;
        if (move_uploaded_file($_FILES['addTaskImg']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $filepath)) {

        } else {
            echo 'Хьюстон! У нас проблемы!';
        }
    }
} else {
    $filepath = "/libs/image/task-img.png";
}

$tasks = R::dispense('tasks');
$tasks->login = $login;
$tasks->email = $email;
$tasks->text = $text;
$tasks->img = $filepath;
$tasks->status = "Открыто";
R::store($tasks);

header("Location: /taskmanager");
