@extends('layouts.main')

@section('content')
    <section class="all-users">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Все пользователи</h2>
                </div>
            </div>
            <users-component asset="<?=asset('img/users')?>" default-image="<?=asset('img') . '/no-photo.png'?>"></users-component>
        </div>
    </section>
@endsection