@extends('layouts.main')

@section('content')
    <message-component
            user-one='<?=auth()->user()?>'
            user-two='<?=$user2?>'
            asset="<?=asset('img/users')?>"
            default-image="<?=asset('img') . '/no-photo.png'?>"
            session-id="<?=$session->id?>"
            :online-users="onlineUsers"
    ></message-component>
@endsection