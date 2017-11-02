function checkIn() {
    $('#sing-up__form').submit(function(e) {
        e.preventDefault();

        var login = $("#login").val();
        var email = $("#email").val();
        var password = $("#password").val();

        if (login == "" || email == "" || password == "") {
            alert("Заполните все данные, пожалуйста.");
        }

        $.ajax({
            method: "POST",
            url: "http://it.ansee.su/taskmanager/libs/php/signup.php",
            dataType: "html",
            data: {
                login: login,
                email: email,
                password: password
            },
            success: function() {
                alert("Вы успешно зарегистрировалисью Войдите под своими учетными данными.");
                $(".auth-form__signup").hide(500);
            },
            error: function() {
                alert("Пожалуйста, проверьте правильность введенных данных.");
            }
        });
    });
}

function authorization() {
    $('#sign-in__form').submit(function(e) {
        e.preventDefault();

        var loginAuth = $("#loginAuth").val();
        var passwordAuth = $("#passwordAuth").val();

        if (loginAuth == "" || passwordAuth == "") {
            alert("Заполните все данные, пожалуйста.");
        }

        $.ajax({
            method: 'POST',
            url: "http://it.ansee.su/taskmanager/libs/php/signin.php",
            data: {
                loginAuth: loginAuth,
                passwordAuth: passwordAuth
            },
            success: function(data) {
                console.log(data);
                if (data.indexOf("admin") + 1) {
                    window.location.href = '/admin';
                }
                if (data == 'auth') {
                    alert("Успешная авторизация");
                    $(".auth-form__signin").hide(500);
                    location.reload();
                }
                if (data == 'fail') {
                    alert("Проверьте правильность введенных данных.");
                }
            }
        });
    });
}

// Редактирование на лету

function editing() {

    var oldValue, newValue, id;

    var text, status, user, email;


    $(".edit").keypress(function(event) {
        if (event.which == 13) {
            return false;
        }
    });

    $(".edit-status").focus(function() {
        oldValue = $(this).text();
        id = $(this).data("id");
        console.log(oldValue + " " + id);
    }).blur(function() {
        newValue = $(this).text();
        if (newValue != oldValue) {
            $.ajax({
                url: "http://it.ansee.su/taskmanager/libs/php/admEdit.php",
                type: "POST",
                data: {
                    newValue: newValue,
                    id: id
                },
                beforeSend: function() {
                    $(".loader").fadeIn();
                },
                success: function(res) {
                    $(".update-result").text(res).delay(500).fadeIn(1000, function() {
                        $(".update-result").delay(1000).fadeOut();
                    });
                },
                error: function() {
                    alert("Не удалось отредактировать данные!");
                },
                complete: function() {
                    $(".loader").delay(500).fadeOut();
                }
            });
        }
    });

    $(".edit-text").focus(function() {

        oldValueText = $(this).text();
        id = $(this).data("id");

    }).blur(function() {
        newValueText = $(this).text();
        if (newValueText != oldValueText) {
            $.ajax({
                url: "/libs/php/admEdit.php",
                type: "POST",
                data: {
                    newValueText: newValueText,
                    id: id
                },
                beforeSend: function() {
                    $(".loader").fadeIn();
                },
                success: function(res) {
                    $(".update-result").text(res).delay(500).fadeIn(1000, function() {
                        $(".update-result").delay(1000).fadeOut();
                    });
                },
                error: function() {
                    alert("Не удалось отредактировать данные!");
                },
                complete: function() {
                    $(".loader").delay(500).fadeOut();
                }
            });
        }
    });

    $(".edit-user").focus(function() {

        oldValueUser = $(this).text();
        id = $(this).data("id");

    }).blur(function() {
        newValueUser = $(this).text();
        if (newValueUser != oldValueUser) {
            $.ajax({
                url: "http://it.ansee.su/taskmanager/libs/php/admEdit.php",
                type: "POST",
                data: {
                    newValueUser: newValueUser,
                    id: id
                },
                beforeSend: function() {
                    $(".loader").fadeIn();
                },
                success: function(res) {
                    $(".update-result").text(res).delay(500).fadeIn(1000, function() {
                        $(".update-result").delay(1000).fadeOut();
                    });
                },
                error: function() {
                    alert("Не удалось отредактировать данные!");
                },
                complete: function() {
                    $(".loader").delay(500).fadeOut();
                }
            });
        }
    });

    $(".edit-email").focus(function() {

        oldValueEmail = $(this).text();
        id = $(this).data("id");

    }).blur(function() {
        newValueEmail = $(this).text();
        if (newValueEmail != oldValueEmail) {
            $.ajax({
                url: "http://it.ansee.su/taskmanager/libs/php/admEdit.php",
                type: "POST",
                data: {
                    newValueEmail: newValueEmail,
                    id: id
                },
                beforeSend: function() {
                    $(".loader").fadeIn();
                },
                success: function(res) {
                    $(".update-result").text(res).delay(500).fadeIn(1000, function() {
                        $(".update-result").delay(1000).fadeOut();
                    });
                },
                error: function() {
                    alert("Не удалось отредактировать данные!");
                },
                complete: function() {
                    $(".loader").delay(500).fadeOut();
                }
            });
        }
    });

}

function delete_task() {

    $("#delete-item").on("click", function() {
        var idForDelete = $(this).data("id");
        console.log(idForDelete);
        $.ajax({
            url: 'http://it.ansee.su/taskmanager/libs/php/admEdit.php',
            type: "POST",
            data: {
                idForDelete: idForDelete
            },
            beforeSend: function() {
                $(".loader").fadeIn();
            },
            success: function(res) {
                $(".update-result").text(res).delay(500).fadeIn(1000, function() {
                    $(".update-result").delay(1000).fadeOut();
                });
            },
            error: function() {
                alert("Не удалось отредактировать данные!");
            },
            complete: function() {
                $(".loader").delay(500).fadeOut();
            }
        });
    });

}

function preview() {
    
    $("#previewBtn").on("click", function() {
        
        var username = $("input[name='addTaskLogin']").val();
        var email = $("input[name='addTaskEmail']").val();
        
        if (!username) {
            username = $(".sessionLogin").text();
        } else {
            username = $("input[name='addTaskLogin']").val();
        }
        
        if (!email) {
            email = $(".sessionEmail").text();
        } else {
            email = $("textarea[name='addTaskEmail']").val();
        }
        
        var text = $("textarea[name='addTaskText']").val();
        var imgFile = $("input[name='addTaskImg']").val();
        
        if (text === "" || username === "" || email === "") {
            alert('Введите данные.');
        } else {
            
            $(".preview").html("<h2>Предварительный просмотр</h2><div class='close'><i class='fa fa-times-circle' aria-hidden='true'></i></div><div class='task-list'><div class='task-list__item'><div class='task-list__item__img'><img id='img-preview' src='' /></div><div class='task-list__item__content'>" +text+ "</div><div class='task-list__item__info'><div class='task-list__item__info-user'>" +username+ "</div><div class='task-list__item__info-email'>" +email+ "</div></div></div></div> <span id='output'></span>");

            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $('#img-preview').attr('src', e.target.result);
                    };
            
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $("#file").change(function(){
                readURL(this);
            });
    
            $(".preview").show(500);
    
            $(".close").on("click", function() {
                $(".preview").hide(500);
            });
            
        }
        
    
        });
}

$(document).ready(function() {

    // ==== Без клика - не отображаем формы на странице
    var signUpForm = $(".auth-form__signup").hide();
    var signInForm = $(".auth-form__signin").hide();
    var addTaskForm = $(".add-task-form").hide();
    // ==== Без клика - не отображаем формы на странице

    // Открываем формы по клику
    $("#sign-in__btn").on("click", function() {
        $(signInForm).show(300);
        $(".auth-form__signin-close").on("click", function() {
            $(signInForm).hide(300);
        });
    });

    $("#sign-up__btn").on("click", function() {
        $(signUpForm).show(300);
        $(".auth-form__signin-close").on("click", function() {
            $(signUpForm).hide(300);
        });
    });

    $("#add-task__btn").on("click", function() {
        $(addTaskForm).show(300);
        $(".auth-form__signin-close").on("click", function() {
            $(addTaskForm).hide(300);
        });
    });
    // Открываем формы по клику


    // Сортировка
    $(".sort-line a").on("click", function() {
        var sort = $(this).attr("id");
        console.log(sort);
        $.ajax({
            url: 'http://it.ansee.su/taskmanager/libs/php/sorting.php',
            type: 'get',
            data: 'sort=' + sort,
            success: function(data) {
                $(".task-list").html(data).hide().fadeIn(2000);
                $(".pagination").html("");
            }
        });
    });
    // Конец сортировки

    checkIn();
    authorization();
    editing();
    delete_task();
    preview();
    
    $(function(){
        $(".about-project .close").click(function(){
            $(".about-project").slideUp(500);
        });
    });

});