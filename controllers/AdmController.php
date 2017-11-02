<?php

include_once(ROOT."/models/Tasks.php");

class AdmController {
    public function actionShowTask() {
        $returnArray = Tasks::getPage();
        $page = $returnArray[0];
        $pagesCount = $returnArray[1];
        $taskList = Tasks::getTasksList();
        require_once(ROOT."/views/adm/index.php");
        return true;
    }
}