@extends('layouts.main')

@push('scripts')
    <script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endpush
@section('content')
    <section class="login">
        <div class="container">
            <h2>Редактирование страницы</h2>
            <div class="row justify-content-center">
                <div class="col-8">
                    <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email">Введите свой email:</label>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Введите email" value="{{old('email') ? old('email') : $user->email}}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="firstname">Введите своё имя:</label>
                            <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="firstname" placeholder="Введите имя" value="{{old('first_name') ? old('first_name') : $user->first_name}}">
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="secondname">Введите свою фамилию:</label>
                            <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="secondname" placeholder="Введите фамилию" value="{{old('last_name') ? old('last_name') : $user->last_name}}">
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="city">Введите свой город:</label>
                            <input type="text" name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" id="city" placeholder="Введите город" value="{{old('city') ? old('city') : $user->city}}">
                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="age">Сколько вам лет:</label>
                            <select class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" id="age" name="age" >
                                @for($i = 15; $i <= 99; $i++)
                                    <option value="{{$i}}" {{(old('age') == $i || $i == $user->age) ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('age'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('age') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Введите свой мобильный телефон:</label>
                            <input type="number" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" placeholder="Введите телефон" value="{{old('phone') ? old('phone') : $user->phone}}">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="about">Роскажите о себе:</label>
                            <textarea name="about" id="about" placeholder="О себе" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}" rows="10" >{{old('about') ? old('about') : $user->about}}</textarea>
                            @if ($errors->has('about'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('about') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="img">Загрузите своё изображение:</label>
                            <input type="file" name="image" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" id="img">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                            <div id="output">
                                @if($user->img)
                                    <img src="{{asset('img/users') . '/' . $user->img}}" alt="" class="user-image">
                                @endif
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="password">Ваш пароль:</label>--}}
                            {{--<input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="Введите пароль" value="{{old('password') ? old('password') : ''}}">--}}
                            {{--@if ($errors->has('password'))--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                {{--<strong>{{ $errors->first('password') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="password2">Повторно ваш пароль:</label>--}}
                            {{--<input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password2" placeholder="Введите пароль" value="{{old('password_confirmation') ? old('password_confirmation') : ''}}">--}}
                            {{--@if ($errors->has('password_confirmation'))--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="form-group form-check">--}}
                            {{--<input type="checkbox" name="remember" class="form-check-input" id="remember" {{old('remember') ? 'checked' : ''}}>--}}
                            {{--<label class="form-check-label" for="remember">Запомнить меня</label>--}}
                        {{--</div>--}}
                        <button type="submit" class="btn btn-success">Редактировать</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
