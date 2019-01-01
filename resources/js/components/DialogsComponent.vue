<template>
    <section class="all-messages">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Диалоги</h2>
                </div>
            </div>
            <div class="message d-flex" v-for="dialog in dialogs" v-if="dialog && dialog.user && dialog.last_message">
                <div class="row">
                    <div class="col-3">
                        <div class="img-wrapp">
                            <a :href="renderUserRoute(dialog.user)">
                                <img :src="renderImage(dialog.user)" onerror="this.className +=' invalid'" alt="" class="image-error">
                            </a>
                        </div>
                    </div>
                    <div class="col-9">
                        <a :href="renderUserRoute(dialog.last_message.user)" class="first-name">{{dialog.user.first_name}} {{dialog.user.last_name}}</a>
                        <div class="msg-info align-self-end">
                            <div class="row">
                                <div class="col-2">
                                    <div class="img-inner-wrapp">
                                        <a :href="renderUserRoute(dialog.last_message.user)">
                                            <img :src="renderImage(dialog.last_message.user)" onerror="this.className +=' invalid'" alt="" class="image-error">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <a class="msg-text" :href="renderMessageRoute(dialog.user)">
                                        {{dialog.last_message.message.substring(0,50)}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>

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
              dialogs: []
          }
        },
        methods: {
            trigger(message) {
                this.dialogs.forEach((dialog) => {
                    if (dialog.id == message.chat.session_id) {
                        dialog.last_message.message = message.content;
                    }
                });
            },
            getDialogs() {
                axios.post(`/sessions`).then(res => {
                    this.dialogs = res.data.data;
                });
            },
            renderImage(user) {
                if (user.img) {
                    return this.asset + '/' + user.img;
                }
                return this.defaultImage;
            },
            renderUserRoute(user) {
                return this.userRoute + "/" + user.id;
            },
            renderMessageRoute(user) {
                return this.messageRoute + "/" + user.id;
            }
        },
        props: ['userId', 'asset', 'defaultImage', 'userRoute', 'messageRoute'],
        created: function () {
            this.getDialogs();
        }
    }
</script>