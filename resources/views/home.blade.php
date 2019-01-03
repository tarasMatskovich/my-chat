@extends('layouts.main')

@section('content')
    <section class="all-users">
        <div class="container">
            <users-component
                    asset="<?=asset('img/users')?>"
                    default-image="<?=asset('img') . '/no-photo.png'?>"
                    message-url="<?=route('messages.message',['id'=>''])?>"
                    :online-users="onlineUsers"
                    ref="user"
                    :all-online-users="allOnlineUsers"
            ></users-component>
        </div>
    </section>
@endsection