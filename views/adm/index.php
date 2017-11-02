<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Админпанель приложения-задачника</title>
    <meta name="viewport" content="width=device-width">

    <link rel="shortcut icon" href="<?php ROOT ?>/libs/image/favicon.png" type="image/x-icon">

    <?php include_once(ROOT . '/views/layouts/connections.php'); ?>

</head>
<body>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="top-line">
                    <div class="top-line__logo"><a href="http://it.ansee.su/taskmanager/admin">Task <i class="fa fa-check-circle" aria-hidden="true"></i> Manager <sup>Admin</sup></a></div>
                    <div class="top-line__auth-form">

                        <?php if(isset($_SESSION['login']) ) : ?>
                        Добро пожаловать, <b><?php echo $_SESSION['login']; ?></b>!
                        <a href="http://it.ansee.su/taskmanager/libs/php/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a>
                        <?php else : ?>

                        <button id="sign-in__btn" class="top-line__auth-form__input btn btn-sm btn-success">
                            Войти
                        </button>
                        <button id="sign-up__btn" class="top-line__auth-form__input btn btn-sm btn-success">
                            Регистрация
                        </button>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-form__signin">
        <form method="POST" action="http://it.ansee.su/taskmanager/libs/php/signin.php" id="sign-in__form">
            <div class="auth-form__signin-close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="form-group">
                <label for="loginAuth">Логин:</label>
                <input type="text" name="loginAuth" class="form-control" id="loginAuth" value="<?php @$data['login-auth'] ?>">
            </div>
            <div class="form-group">
                <label for="passwordAuth">Пароль:</label>
                <input type="password" name="passwordAuth" class="form-control" id="passwordAuth" value="<?php @$data['password-auth'] ?>">
            </div>
            <input class="btn btn-success text-center" type="submit" value="Войти" name="submit" id="do_auth">
        </form>
    </div>

    <div class="auth-form__signup">
        <form method="POST" action="http://it.ansee.su/taskmanager/libs/php/signup.php" id="sing-up__form">
            <div class="auth-form__signin-close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="form-group">
                <label for="login">Логин:</label>
                <input name="login" type="text" class="form-control" id="login" value="<?php @$data['login'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input name="email" type="email" class="form-control" id="email" value="<?php @$data['email'] ?>">
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input name="password" type="password" class="form-control" id="password"
                       value="<?php @$data['password'] ?>">
            </div>
            <input class="btn btn-success text-center" type="submit" value="Зарегистрироваться" name="submit" id="do_register">
        </form>
    </div>

</header>

<div class="content">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12 col-sm-12">
                <button id="add-task__btn" class="btn__add-task btn btn-danger btn-lg">Добавить задачу <i class="fa fa-pencil-square-o"
                                                                                       aria-hidden="true"></i></button>
                <div class="add-task-form">
                    <form method="POST" action="http://it.ansee.su/taskmanager/libs/php/addTask.php" enctype="multipart/form-data" id="add-task">

                        <div class="auth-form__signin-close"><i class="fa fa-times" aria-hidden="true"></i></div>

                        <?php if(!isset($_SESSION['login']) ) : ?>
                        <div class="form-group">
                            <label for="">Имя пользователя:</label>
                            <input type="text" name="addTaskLogin" class="form-control" value="<?php @$_SESSION['login'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Email:</label>
                            <input type="text" name="addTaskEmail" class="form-control" value="<?php @$_SESSION['email'] ?>">
                        </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['login'])) echo "<b>Ваш логин: </b><div class='sessionLogin'>".$_SESSION['login']."</div><br><b>Ваш email: </b><div class='sessionEmail'>".$_SESSION['email']."</div><br>"; ?>

                        <div class="form-group">
                            <label for="">Текст задачи:</label>
                            <textarea type="text" name="addTaskText" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Добавить изображение</label>
                            <input type="file" accept="image/*" name="addTaskImg" id="file" class="form-control">
        
                        </div>

                        <div class="buttons">
                            <input type="submit" class="form-control btn btn-success" id="addTskBtn" value="Добавить">
                            <input type="" class="btn btn-link" id="previewBtn" value="Предварительный просмотр">
                        </div>

                        <div class="preview" style="display: none;"></div>

                    </form>

                </div>
                
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12 col-sm-12">
                <div class="sort-line">
                    <div class="sort-line__item1"><a href="#" id="sort-status">По статусу</a></div>
                    <div class="sort-line__item2"><a href="#" id="sort-username">По имени пользователя</a></div>
                    <div class="sort-line__item3"><a href="#" id="sort-email">По эл. адресу</a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="task-list">

                    <?php if (isset($taskList)) foreach ($taskList as $taskItem): ?>
                        <div class="task-list__item">
                            <div class="task-list__item__img">
                                <img src="<?php echo $taskItem->img ?>" class="img-fluid" width="320" alt="">
                            </div>
                            <div class="task-list__item__content edit-text" data-id="<?php echo $taskItem->id ?>" contenteditable>
                                <?php echo $taskItem->text ?>
                            </div>
                            <div class="task-list__item__info">
                                <div class="task-list__item__info-status edit-status" data-id="<?php echo $taskItem->id ?>" contenteditable><?php echo $taskItem->status ?></div>
                                <div class="task-list__item__info-user edit-user" data-id="<?php echo $taskItem->id ?>" contenteditable><?php echo $taskItem->login ?></div>
                                <div class="task-list__item__info-email edit-email" data-id="<?php echo $taskItem->id ?>" contenteditable><?php echo $taskItem->email ?></div>

                                <div class="controll-items"> 
                                    <a href="#" id="delete-item" data-id="<?php echo $taskItem->id ?>">Удалить</a>    
                                </div>  
                                
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="pagination">
                    <?php if (isset($pagesCount)) for ($x = 1; $x <= $pagesCount; $x++): ?>
                        <a href="?page=<?php echo $x; ?>" <?php if (isset($page) && $page === $x) echo 'class="selected"' ?> ><?php echo $x; ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="footer__copy">© <?php echo date('Y') ?> Приложение-задачник «<a href="<?php echo ROOT; ?>">Task
                        Manager</a>»</div>
            </div>
        </div>
    </div>
</footer>

<div class="loader"></div>
<div class="update-result">Данные отредактированы.</div>

</body>
</html>