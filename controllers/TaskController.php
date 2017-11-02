<?php

include_once(ROOT."/models/Tasks.php");

class TaskController {

    public function actionIndex() {
        $returnArray = Tasks::getPage();
        $page = $returnArray[0];
        $pagesCount = $returnArray[1];
        $taskList = Tasks::getTasksList();
        require_once(ROOT."/views/tasks/index.php");

        return true;
    }

}