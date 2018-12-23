
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

Vue.component('main-component', require('./components/MainComponent'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('users-component', require('./components/UsersComponent.vue'));
Vue.component('pagination-component', require('./components/PaginationComponent.vue'));
Vue.component('message-component', require('./components/MessageComponent'));

const app = new Vue({
    el: '#app',
    data: function () {
        return {
            users: [],
            totalUsers: 0,
            perPage: 3,
            currentPage:1,
            onlineUsers: []
        };
    },
    methods: {
        getUsers: function (page) {
            axios.post('/users',{page:page}).then(res => {
                this.users = res.data.users;
                this.users.forEach((user) => {
                    this.isOnline(user);
                });
                this.totalUsers = res.data.totalUsers;

                this.currentPage = page;

            });
        },
        isOnline: function (user) {
            let matched = false;
            this.onlineUsers.forEach((onlineUser) => {
                if (onlineUser.id == user.id) {
                    user.online = true;
                    matched = true;
                }
            });
            if (!matched) {
                user.online = false;
            }
        },
    },
    created: function () {
        Echo.join('Chat')
            .here((users) => {
                users.forEach((user) => {
                    this.onlineUsers.push(user.id);
                });
                this.$refs.user.checkOnline();
                // this.getUsers(this.currentPage);
            })
            .joining((user) => {
                this.onlineUsers.push(user.id);
                this.$refs.user.checkOnline();

                // this.users.forEach((user) => {
                //     this.isOnline(user);
                // });
                // alert('joining');
                // console.log(this.users);
            })
            .leaving((user) => {
                this.onlineUsers.forEach((onlineUser,index) => {
                    if (onlineUser == user.id) {
                        this.onlineUsers.splice(index, 1);
                    }
                });
                this.$refs.user.checkOnline();
                // alert('leaving');
                // console.log(this.users);
                // this.users.forEach((user) => {
                //     this.isOnline(user);
                // });
            });
    }
});
