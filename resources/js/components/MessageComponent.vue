<template>
    <section class="user-message">
        <div class="container">
            <div class="controls">
                <div class="row">
                    <div class="col-2">
                        <a href="#" class="back">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="back sm-hide">Назад</a>
                    </div>
                    <div class="col-8">
                        <div class="info">
                            <a href="#">{{user2.first_name}} {{user2.last_name}}</a><br>
                            <p>
                                был в сети сегодня в 1:29
                            </p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="dop-info">
                            <i class="fas fa-ellipsis-h more-msg-info">
                            </i>
                            <div class="sub-menu" id="show-more-info-msg">
                                <ul>
                                    <li>
                                        <a href="#">Очистить историю сообщений</a>
                                    </li>
                                    <li>
                                        <a href="#">Заблокировать пользователя</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="img sm-hide">
                                <img :src="asset + '/' + user2.img" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="messages">
                <div class="msg-info" v-for="message in messages">
                    <div :class="{'row':message.type == 0, 'row justify-content-end':message.type == 1}">
                        <div :class="{'col-md-1 col-2':message.type == 0, 'col-md-4 col-3':message.type == 1}">
                            <div class="img-wrapp" v-if="message.type == 0">
                                <a href="#">
                                    <img :src="asset + '/' + user1.img" alt="">
                                </a>
                            </div>
                            <div class="date text-right" v-else>
                                {{message.send_at}}
                            </div>
                        </div>
                        <div class="col-md-7 col-7">
                            <div :class="{'msg':message.type == 0, 'msg answer':message.type == 1}">
                                {{message.message}}
                            </div>
                        </div>
                        <div :class="{'col-md-4 col-3':message.type == 0, 'col-md-1 col-2':message.type == 1}">
                            <div class="date" v-if="message.type == 0">
                                {{message.send_at}}
                            </div>
                            <div class="img-wrapp" v-else>
                                <a href="#">
                                    <img :src="asset + '/' + user2.img" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="send-message">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <form class="form-group" @submit.prevent="send">
                            <input type="text" v-model="message" placeholder="Напишите сообщение..." class="form-control">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                user1 : JSON.parse(this.userOne),
                user2 : JSON.parse(this.userTwo),
                message:null,
                messages:[]
            }
        },
        props: ['userOne', 'userTwo', 'asset', 'defaultImage', 'sessionId'],
        methods: {
            pushToChats(message) {
                this.messages.push({
                    message:message,
                    type:0,
                    send_at:'Just now',
                    read_at:null
                });
            },
            send() {
                if (this.message) {
                    this.pushToChats(this.message);
                    axios.post(`/send/${this.sessionId}`, {
                        content : this.message,
                        to_user : this.user2.id
                    }).then(res => {
                        this.messages[this.messages.length - 1].id = res.data;
                    });
                    this.message = null;
                }
            },
            getAllMessages() {
                axios.post(`/session/${this.sessionId}/chats`).then(res => {
                    this.messages = res.data.data;
                });
            }

        },
        created: function () {
            this.getAllMessages();
        }
    }
</script>