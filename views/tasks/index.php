<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Приложение-задачник</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="http://it.ansee.su/taskmanager//libs/image/favicon.png" type="image/x-icon">

    <?php include_once(ROOT . '/views/layouts/connections.php'); ?>

</head>
<body>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="top-line">
                    <div class="top-line__logo"><a href="/taskmanager">Task <i class="fa fa-check-circle" aria-hidden="true"></i> Manager</a></div>
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

                <div class="about-project alert alert-success text-left">
                    <span class="close">&times;</span>
                    <b><i class="fa fa-graduation-cap" aria-hidden="true"></i> Лабораторная работа №2: <br> </b>
                    Разработка просто web-приложения<br><br>
                    
                    <b><i class="fa fa-tasks" aria-hidden="true"></i> Задача:</b><br>
                    Cпроектировать и разработать индивидуальное или коллективное веб-приложение с использованием HTML / CSS / JS + JSON | XML<br><br>
                    
                    <b><i class="fa fa-diamond" aria-hidden="true"></i> Команда:</b><br>
                    GodDev<br><br>
                    
                    <b><i class="fa fa-list-alt" aria-hidden="true"></i> Участники команды и роли:</b><br>
                    <b>Блохин Михаил</b> - проект-менеджер и проектировщик<br>
                    <b>Сайгутина Ирина</b> - ведущий программист, frontend-разработчик<br>
                    <b>Спиридонова Екатерина</b> - backend-разработчик и реализатор<br>
                    <b>Печников Никита</b> - IT-консультант и эксперт
                </div>        
                
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

                        <?php if (isset($_SESSION['login'])) echo "<b>Ваш логин: </b>".$_SESSION['login']."<br><b>Ваш email: </b>".$_SESSION['email']."<br><br>"; ?>

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
                                <img src="http://it.ansee.su/taskmanager/<?php echo $taskItem->img ?>" class="img-fluid" width="320" alt="">
                            </div>
                            <div class="task-list__item__content">
                                <?php echo $taskItem->text ?>
                            </div>
                            <div class="task-list__item__info">
                                <div class="task-list__item__info-status"><?php echo $taskItem->status ?></div>
                                <div class="task-list__item__info-user"><?php echo $taskItem->login ?></div>
                                <div class="task-list__item__info-email"><?php echo $taskItem->email ?></div>
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
                <div class="footer__copy">© <?php echo date('Y') ?> Приложение-задачник «<a href="http://it.ansee.su/taskmanager/">Task
                        Manager</a>»</div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>