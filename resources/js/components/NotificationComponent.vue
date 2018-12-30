<template>
    <div class="notification" @click="goToMessage()">
        <div class="row">
            <div class="col-4">
                <img :src="this.asset + '/' + this.message.user.img" alt="">
            </div>
            <div class="col-8">
                <div class="body">
                    <h5>У вас новое сообщение</h5>
                    <p class="name">
                        {{this.message.user.first_name}} {{this.message.user.last_name}}
                    </p>
                    <p>
                        {{this.message.content.substring(0,27)}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .notification {
        width: 400px;
        background-color: #333333;
        color: #fff;
        padding: 20px;
        position: absolute;
        right: 50px;
        bottom: 50px;
        border-radius: 15px;
        cursor: pointer;
        -webkit-box-shadow: 13px 10px 20px 1px rgba(0,0,0,0.73);
        -moz-box-shadow: 13px 10px 20px 1px rgba(0,0,0,0.73);
        box-shadow: 13px 10px 20px 1px rgba(0,0,0,0.73);
    }

    .notification img {
        border-radius: 50%;
    }
</style>

<script>
    export default {
        props: ['show', 'message', 'asset'],
        methods: {
            goToMessage() {
                window.location.href = window.location.origin + '/messages/' + this.message.user.id;
            }
        },
        created: function () {

        }
    }
</script>