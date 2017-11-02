<?php

class Tasks {

    public static function getPage() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 3;
        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
        $total = R::count('tasks');
        $pagesCount = ceil($total / $perPage);
        $returnPage = array($page, $pagesCount, $start, $perPage);
        return $returnPage;
    }

    public static function getTasksList() {
        $pages = self::getPage();
        $taskList = R::find('tasks', "ORDER BY `id` DESC LIMIT ?,? ", array($pages[2], $pages[3]));
        return $taskList;
    }
    
}