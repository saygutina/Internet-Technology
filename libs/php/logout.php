<?php

require_once "../../components/DB_Connect.php";

session_destroy();

header('Location: /taskmanager');