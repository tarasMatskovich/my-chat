@extends('layouts.main')

@section('content')
    <dialogs-component :user-id="<?=auth()->id()?>" asset="<?=asset("img/users")?>" default-image="<?=asset('img') . '/no-photo.png'?>" user-route="<?=route('user', ['id' => ''])?>" message-route="<?=route("messages.message", ['id' => ''])?>">
    </dialogs-component>
@endsection