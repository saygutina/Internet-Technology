<?php 

require_once "../../components/DB_Connect.php";

if (isset($_POST['newValue'])) {
    if (update_data()) {
        exit("Данные сохранены");
    } else {
        exit("Ошибка сохранения");
    }
}

if (isset($_POST['newValueText'])) {
    if (update_text()) {
        exit("Данные сохранены");
    } else {
        exit("Ошибка сохранения");
    }
}

if (isset($_POST['newValueUser'])) {
    if (update_user()) {
        exit("Данные сохранены");
    } else {
        exit("Ошибка сохранения");
    }
}

if (isset($_POST['newValueEmail'])) {
    if (update_email()) {
        exit("Данные сохранены");
    } else {
        exit("Ошибка сохранения");
    }
}

if (isset($_POST['idForDelete'])) {
    if (delete_task()) {
        exit("Запись удалена.");
    } else {
        exit("Ошибка удаления.");
    }
}

function update_data() {
    $newValue = $_POST['newValue'];
    $id = $_POST['id'];

    $updateTask = R::exec( 'update tasks set status = ? where id = ?', array($newValue, $id));
    return true;
}

function update_text() {
    $newValue = $_POST['newValueText'];
    $id = $_POST['id'];

    $updateTask = R::exec( 'update tasks set text = ? where id = ?', array($newValue, $id));
    return true;
}

function update_user() {
    $newValue = $_POST['newValueUser'];
    $id = $_POST['id'];

    $updateTask = R::exec( 'update tasks set login = ? where id = ?', array($newValue, $id));
    return true;
}

function update_email() {
    $newValue = $_POST['newValueEmail'];
    $id = $_POST['id'];

    $updateTask = R::exec( 'update tasks set email = ? where id = ?', array($newValue, $id));
    return true;
}

function delete_task() {
    $idForDelete = $_POST['idForDelete'];

    $updateTask = R::exec( 'delete from tasks where id = ?', array($idForDelete));
    return true;
}
