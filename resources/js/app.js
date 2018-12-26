
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-chat-scroll'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('users-component', require('./components/UsersComponent.vue'));
Vue.component('pagination-component', require('./components/PaginationComponent.vue'));
Vue.component('message-component', require('./components/MessageComponent'));
Vue.component('notification-component', require('./components/NotificationComponent.vue'));

const app = new Vue({
    el: '#app',
    data: function () {
        return {
            onlineUsers: [],
            allUsers:[],
            showNotification:false,
            message:null,
            allOnlineUsers:[]
        };
    },
    methods: {
        findFullUser(user) {
            var neededUser = null;
            this.allUsers.forEach((fullUser) => {
                if (fullUser.id == user.id)
                    neededUser = fullUser;
            });
            return neededUser;
        },
        addUserToOnline(user) {
            user.online = true;
            this.allOnlineUsers.push(user);
            if (this.$refs.user != undefined) {
                this.$refs.user.getOnlineUsers(this.$refs.user.currentOnlinePage);
            }
        },
        deleteUserFromOnline(user) {
            this.allOnlineUsers.forEach((onlineUser,index) => {
                if (onlineUser.id == user.id) {
                    this.allOnlineUsers.splice(index, 1);
                }
            });
            if (this.$refs.user != undefined) {
                this.$refs.user.getOnlineUsers(this.$refs.user.currentOnlinePage);
            }
        },
        isOnline: function (user) {
            let matched = false;
            this.onlineUsers.forEach((onlineUser) => {
                if (onlineUser == user.id) {
                    user.online = true;
                    matched = true;
                }
            });
            if (!matched) {
                user.online = false;
            }
            return matched;
        },
        createOnlineUsers() {
            this.allUsers.forEach((user) => {
                if (this.isOnline(user)) {
                    this.allOnlineUsers.push(user);
                }
            });
            if (this.$refs.user != undefined) {
                this.$refs.user.getOnlineUsers(1);
            }
        },
        playNotificationSound()
        {
            var promise = document.getElementById("notification-sound").play();
            if (promise !== undefined) {
                promise.then(_ => {
                    // Autoplay started!
                }).catch(error => {
                    // Autoplay was prevented.
                    // Show a "Play" button so that user can start playback.
                });
            }
        },
        hideNotification() {
            this.showNotification = false;
            this.message = null;
            alert("Done");
        },
        notifyAboutMessage(e) {
            this.showNotification = true;
            this.message = e;
            this.playNotificationSound();
            var self = this;
            setTimeout(() => {
                self.showNotification = false;
            },5000);
        },
        listenForEverySession(user) {
            Echo.private(`Chat.${user.session.id}`).listen("PrivateChatEvent", (e) => {
                // if (!user.session.open) {
                //     user.session.unreadCount++;
                // }
                this.notifyAboutMessage(e);
            });
        },
        getAllUsers() {
            axios.post('/users/all').then(res => {
                this.allUsers = res.data.data;
                this.allUsers.forEach(user => {
                    if (user.session) {
                        this.listenForEverySession(user);
                    }
                });
                this.createOnlineUsers();
            });
        }
    },
    created: function () {
        Echo.join('Chat')
            .here((users) => {
                users.forEach((user) => {
                    this.onlineUsers.push(user.id);
                });
                if (this.$refs.user != undefined) {
                    this.$refs.user.checkOnline();
                }
                this.getAllUsers();
            })
            .joining((user) => {
                this.onlineUsers.push(user.id);
                if (this.$refs.user != undefined) {
                    this.$refs.user.checkOnline();
                }
                var fullUser = this.findFullUser(user);
                if (fullUser) {
                    this.addUserToOnline(fullUser);
                }
            })
            .leaving((user) => {
                this.onlineUsers.forEach((onlineUser,index) => {
                    if (onlineUser == user.id) {
                        this.onlineUsers.splice(index, 1);
                    }
                });
                if (this.$refs.user != undefined) {
                    this.$refs.user.checkOnline();
                }
                this.deleteUserFromOnline(user);
            });
    }
});
