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
                                {{getStatus()}}
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
            <div class="messages" v-chat-scroll>
                <div class="msg-info" v-for="message in messages">
                    <div :class="{'row':message.type == 0, 'row justify-content-end':message.type == 1}">
                        <div :class="{'col-md-1 col-2':message.type == 0, 'col-md-4 col-3':message.type == 1}">
                            <div class="img-wrapp" v-if="message.type == 0">
                                <a href="#">
                                    <img :src="asset + '/' + user1.img" alt="">
                                </a>
                            </div>
                            <div class="date text-right" v-else>
                                <!--<span class="read-box">-->
                                    <!--<i class="fas fa-angle-double-left left" v-if="message.read_at"></i>-->
                                    <!--<i class="fas fa-angle-left left" v-else></i>-->
                                <!--</span>-->
                                {{message.send_at}}
                            </div>
                        </div>
                        <div class="col-md-7 col-7">
                            <div :class="{'msg':message.type == 0, 'msg answer':message.type == 1}" v-html="renderMessage(message.message)"></div>
                        </div>
                        <div :class="{'col-md-4 col-3':message.type == 0, 'col-md-1 col-2':message.type == 1}">
                            <div class="date" v-if="message.type == 0">
                                {{message.send_at}}
                                <span class="read-box">
                                    <i class="fas fa-angle-double-left right" v-if="message.read_at"></i>
                                    <i class="fas fa-angle-left right" v-else></i>
                                </span>
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

<style>
    .read-box i{
        color: #9BD070;
        transform: rotate(-90deg);
        font-size: 20px;
    }
    .read-box i.left {
        margin-right: 5px;
    }
    .read-box i.right {
        margin-left: 5px;
    }
</style>

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
        props: ['userOne', 'userTwo', 'asset', 'defaultImage', 'sessionId', 'onlineUsers'],
        methods: {
            renderMessage(message) {
              var words = message.split(" ");
              var string = "";
              words.forEach((word) => {
                  if (word.length > 80) {
                      var len = word.length;
                      var count = len / 80;
                      count = Math.ceil(count);
                      var i;
                      var subStr = "";
                      for(i = 0; i < count; i++) {
                          subStr += word.substring(i*80,i*80+80);
                          subStr += "<br/>";
                      }
                      string += subStr;
                      string += " ";
                  } else {
                      string += word;
                      string += " ";
                  }
              });

              return string;
            },
            getStatus() {
                if (this.onlineUsers.indexOf(this.user2.id) != -1) {
                    return "В сети";
                } else {
                    return "Нет в сети";
                }
            },
            getDate() {
                var date = new Date();
                var seconds = date.getSeconds();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
                if(minutes < 10) {
                    minutes = "0" + minutes;
                }
                if(hours < 10) {
                    hours = "0" + hours;
                }
                var dateTimeString = hours + ":" + minutes + ":" + seconds;
                return dateTimeString;
            },
            pushToChats(message) {

                var dateTimeString = this.getDate();
                this.messages.push({
                    message:message,
                    type:0,
                    send_at:dateTimeString,
                    read_at:null
                });
            },
            send() {
                if (this.message) {
                    this.pushToChats(this.message);
                    axios.post(`/send/${this.sessionId}`, {
                        msg_content : this.message,
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
            },
            read() {
                axios.post(`/session/${this.sessionId}/read`);
            }

        },
        created: function () {
            this.read();
            this.getAllMessages();
            Echo.private(`Chat.${this.sessionId}`).listen("PrivateChatEvent", (e) => {
                this.read();
                var date = this.getDate();
                this.messages.push({message:e.content, type:1, send_at:date});
            });

            Echo.private(`Chat.${this.sessionId}`).listen("MsgReadEvent", (e) => {
                this.messages.forEach(message => {
                    if (message.id == e.chat.id) {
                        message.read_at = e.chat.read_at.date;
                    }
                });
            });
        }
    }
</script>