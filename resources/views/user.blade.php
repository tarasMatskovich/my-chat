@extends('layouts.main')

@section('content')
    <section class="profile">
        <div class="container">
            <h2>{{$user->first_name}} {{$user->last_name}}</h2>
            <div class="row">
                <div class="col-sm-4">
                    <div class="img-wrapp">
                        <img src="{{$user->img ? asset("img/users/{$user->img}") : asset("img/no-photo.png")}}" alt="" class="img-animated">
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
                            <button type="button" class="btn btn-outline-info">Редактировать страницу</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-danger">Удалить страницу</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection