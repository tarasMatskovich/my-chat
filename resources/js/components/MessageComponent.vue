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
                <!--<div class="msg-info">-->
                    <!--<div class="row">-->
                        <!--<div class="col-md-1 col-2">-->
                            <!--<div class="img-wrapp">-->
                                <!--<a href="#">-->
                                    <!--<img src="img/user2.jpg" alt="">-->
                                <!--</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-7 col-7">-->
                            <!--<div class="msg">-->
                                <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis doloribus aliquid, aliquam architecto dicta explicabo, iste eum doloremque libero, et voluptate commodi. Quas sit deserunt suscipit odit maiores aperiam esse!-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-4 col-3">-->
                            <!--<div class="date">-->
                                <!--22:45-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="msg-info">-->
                    <!--<div class="row justify-content-end">-->
                        <!--<div class="col-md-4 col-3">-->
                            <!--<div class="date text-right">-->
                                <!--13:19-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-7 col-7">-->
                            <!--<div class="msg answer">-->
                                <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores harum, nulla numquam delectus. Minus, commodi, pariatur. Eius cumque, ducimus aliquid iusto quidem earum, nisi iste. Recusandae quos magnam perferendis velit!-->
                                <!--Nulla culpa harum voluptates non itaque et provident impedit in totam quia, magni sit odit laboriosam autem, nobis reiciendis quod consectetur dolor rem aliquam praesentium modi, voluptatem eligendi magnam possimus.-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-1 col-2">-->
                            <!--<div class="img-wrapp">-->
                                <!--<a href="#">-->
                                    <!--<img src="img/user1.jpg" alt="">-->
                                <!--</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="msg-info">-->
                    <!--<div class="row">-->
                        <!--<div class="col-md-1 col-2">-->
                            <!--<div class="img-wrapp">-->
                                <!--<a href="#">-->
                                    <!--<img src="img/user2.jpg" alt="">-->
                                <!--</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-7 col-7">-->
                            <!--<div class="msg">-->
                                <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis doloribus aliquid, aliquam architecto dicta explicabo, iste eum doloremque libero, et voluptate commodi. Quas sit deserunt suscipit odit maiores aperiam esse!-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-4 col-3">-->
                            <!--<div class="date">-->
                                <!--22:45-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="msg-info">-->
                    <!--<div class="row justify-content-end">-->
                        <!--<div class="col-md-4 col-3">-->
                            <!--<div class="date text-right">-->
                                <!--13:19-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-7 col-7">-->
                            <!--<div class="msg answer">-->
                                <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores harum, nulla numquam delectus. Minus, commodi, pariatur. Eius cumque, ducimus aliquid iusto quidem earum, nisi iste. Recusandae quos magnam perferendis velit!-->
                                <!--Nulla culpa harum voluptates non itaque et provident impedit in totam quia, magni sit odit laboriosam autem, nobis reiciendis quod consectetur dolor rem aliquam praesentium modi, voluptatem eligendi magnam possimus.-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-1 col-2">-->
                            <!--<div class="img-wrapp">-->
                                <!--<a href="#">-->
                                    <!--<img src="img/user1.jpg" alt="">-->
                                <!--</a>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="msg-info">-->
                    <!--<div class="row">-->
                        <!--<div class="col-md-1 col-2">-->
                            <!--<div class="img-wrapp">-->
                                <!--<a href="#">-->
                                    <!--<img src="img/user2.jpg" alt="">-->
                                <!--</a>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-7 col-7">-->
                            <!--<div class="msg">-->
                                <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis doloribus aliquid, aliquam architecto dicta explicabo, iste eum doloremque libero, et voluptate commodi. Quas sit deserunt suscipit odit maiores aperiam esse!-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-4 col-3">-->
                            <!--<div class="date">-->
                                <!--22:45-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
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
            send() {
                alert(this.message);
                this.message = null;
            },
            getAllMessages() {
                axios.post(`/session/${this.sessionId}/chats`).then(res => {
                    console.log(res.data);
                });
            }

        },
        created: function () {
            this.getAllMessages();
        }
    }
</script>