<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <title>Messenger</title>
</head>
<body>

<section class="container menu">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.html">MyMessenger</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="messages.html">Сообщения</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.html">Мой профиль</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign_up.html">Зарегистрироваться</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Искать</button>
            </form>
        </div>
    </nav>
</section>

<section class="all-users">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Все пользователи</h2>
            </div>
        </div>
        <div class="user">
            <div class="row">
                <div class="col-md-2">
                    <div class="img-wrapp">
                        <a href="#">
                            <img src="{{asset('img/user1.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <div class="users-info">
                                <h5>
                                    <a href="#" class="name">
                                        Имя Фамилия
                                    </a>
                                </h5>
                                <a href="message.html" class="write-msg">Написать сообщение</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="user">
            <div class="row">
                <div class="col-md-2">
                    <div class="img-wrapp">
                        <a href="#">
                            <img src="{{asset('img/user2.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <div class="users-info">
                                <h5>
                                    <a href="#" class="name">
                                        Имя Фамилия
                                    </a>
                                </h5>
                                <a href="message.html" class="write-msg">Написать сообщение</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="user">
            <div class="row">
                <div class="col-md-2">
                    <div class="img-wrapp">
                        <a href="#">
                            <img src="{{asset('img/user1.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <div class="users-info">
                                <h5>
                                    <a href="#" class="name">
                                        Имя Фамилия
                                    </a>
                                </h5>
                                <a href="message.html" class="write-msg">Написать сообщение</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="pagination">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="footer-wrapp">
            <div class="row">
                <div class="col-md-8">
                    <ul>
                        <li>
                            <a href="#">
                                Главная
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Сообщения
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Мой профиль
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p>&copy; Copyright 2018</p>
                </div>
            </div>
        </div>
    </div>
</footer>







<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>