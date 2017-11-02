<?php

require '../../components/DB_Connect.php';
require '../../models/Tasks.php';

//$pages = Tasks::getPage();
//$taskList = Tasks::sortByStatus();

if (isset($_GET['sort'])) {

    if ($_GET['sort'] == "sort-status") {
        $taskList = R::findAll("tasks", "ORDER BY status");
    }
    if ($_GET['sort'] == "sort-username") {
        $taskList = R::findAll("tasks", "ORDER BY login");
    }
    if($_GET['sort'] == "sort-email") {
        $taskList = R::findAll("tasks", "ORDER BY email");
    }

    foreach ($taskList as $item) {
        printf('<div class="task-list__item">
                            <div class="task-list__item__img">
                                <img src="http://it.ansee.su/taskmanager/%s" class="img-fluid" width="320" alt="">
                            </div>
                            <div class="task-list__item__content">
                                %s
                            </div>
                            <div class="task-list__item__info">
                                <div class="task-list__item__info-status">%s</div>
                                <div class="task-list__item__info-user">%s</div>
                                <div class="task-list__item__info-email">%s</div>
                            </div>
                        </div>', $item->img, $item->text, $item->status, $item->login, $item->email);
    }
    exit();
} else {

}