@extends('layouts.main')

@section('content')
    <section class="profile">
        <div class="container">
            <h2>{{$user->first_name}} {{$user->last_name}}</h2>
            <div class="row">
                <div class="col-sm-4">
                    <div class="img-wrapp">
                        <img src="{{$user->img ? asset("img/users/{$user->img}") : asset("img/no-photo.png")}}" onerror="this.src='{{asset('img/no-photo.png')}}';" alt="" class="img-animated">
                    </div>
                </div>
                <div class="col-sm-8">
                    <h5>Основная информация</h5>
                    <div class="info">
                        <div class="info-row">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="left">Город:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="right">{{$user->city ? $user->city : "Не указано"}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="left">Возраст:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="right">{{$user->age ? $user->age : "Не указано"}}</div>
                                </div>
                            </div>
                        </div>


                        <div class="info-row">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="left">Моб. телефон:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="right">{{$user->phone ? $user->phone : "Не указано"}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="left">О себе:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="right">
                                        {{$user->about ? $user->about : "Не указано"}}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            @if ($user->id == auth()->id())
                <div class="edit">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('user.edit')}}" class="btn btn-outline-info a-button">Редактировать страницу</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteProfile">Удалить страницу</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <form action="{{route('user.delete')}}" method="POST" id="deleteUserForm">
        @csrf
        @method('delete')
    </form>

    <!-- Modal -->
    <div class="modal fade" id="deleteProfile" tabindex="-1" role="dialog" aria-labelledby="deleteProfileLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProfileLabel">Удаление страницы.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить навсегда свою страницу?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <button type="submit" form="deleteUserForm" class="btn btn-danger" id="deleteUser">Да, хочу удалить страницу</button>
                </div>
            </div>
        </div>
    </div>
@endsection