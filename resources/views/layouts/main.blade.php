<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.authId = {!!auth()->id()!!}
            window.auth = {!!auth()->user()!!}
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>


    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <title>Messenger</title>
</head>
<body>
    <div id="app">
        <section class="container menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{route('home')}}">MyMessenger</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('home')}}">Главная <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('messages.messages')}}">Сообщения<unread-count-component :unread-count="unreadCount"></unread-count-component></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user', ['id' => auth()->id()])}}">Мой профиль</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Войти</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('register')}}">Зарегистрироваться</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <form method="POST" action="{{route('logout')}}" id="logout-form">
                                    @csrf
                                </form>
                                <a class="nav-link" href="#" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">Выйти</a>
                            </li>
                        @endguest
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Искать</button>
                    </form>
                </div>
            </nav>
        </section>

        @if (session('success'))
            <section class="success-messages">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <div class="main-content">
            @yield('content')
        </div>
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
        <notification-component :show="showNotification" :message="message" v-if="showNotification" asset="<?=asset('img/users')?>"></notification-component>
        <audio src="{{asset('sounds/sound.mp3')}}" id="notification-sound" muted>
            Your browser does not support the <code>audio</code> element.
        </audio>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/plugins/CSSPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/easing/EasePack.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenLite.min.js"></script>
    <script src="{{asset('js/common.js')}}"></script>
    @stack('scripts')
</body>
</html>