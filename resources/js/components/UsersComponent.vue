<template>
    <div>
        <div class="tabs">
            <div class="row">
                <div class="col">
                    <ul>
                        <li :class="{'active':allUsersActive == true}" @click="makeAllUsersActive()"><a href="#">Все пользователи</a></li>
                        <li :class="{'active':onlineUsersActive == true}" @click="makeOnlineUsersActive()"><a href="#">Онлайн</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="all-users-tab" v-if="allUsersActive">
            <div v-if="this.users.length > 0" class="users">
                <div v-for="user in users" class="user">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="img-wrapp">
                                <a :href="user.user_route">
                                    <img :src="renderImage(user)" onerror="this.className +=' invalid'" alt="" class="image-error">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col">
                                    <div class="users-info">
                                        <h5>
                                            <a :href="user.user_route" class="name">
                                                {{user.first_name}} {{user.last_name}}
                                            </a>
                                            <span v-if="user.online">
                                            <i class="fas fa-circle online"></i>
                                        </span>
                                        </h5>
                                        <a :href="messageUrl + '/' + user.id" class="write-msg">Написать сообщение</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <pagination-component
                        :current="currentPage"
                        :total="totalUsers"
                        :perPage="perPage"
                        @page-changed="getUsers">
                </pagination-component>
            </div>
            <h5 v-else>Пользователей нет</h5>
        </div>
        <div class="online-users-tab" v-else>
            <div v-if="this.allOnlineUsers.length > 0" class="users">
                <div v-for="user in chunkedOnlineUsers" class="user">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="img-wrapp">
                                <a :href="user.user_route">
                                    <img :src="renderImage(user)" onerror="this.className +=' invalid'" alt="" class="image-error">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col">
                                    <div class="users-info">
                                        <h5>
                                            <a :href="user.user_route" class="name">
                                                {{user.first_name}} {{user.last_name}}
                                            </a>
                                            <span v-if="user.online">
                                            <i class="fas fa-circle online"></i>
                                        </span>
                                        </h5>
                                        <a :href="messageUrl + '/' + user.id" class="write-msg">Написать сообщение</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <pagination-component
                        :current="currentOnlinePage"
                        :total="allOnlineUsers.length"
                        :perPage="perPage"
                        @page-changed="getOnlineUsers">
                </pagination-component>
            </div>
            <h5 v-else>Пользователей онлайн нет</h5>
        </div>
    </div>
</template>

<style>
    .tabs ul li {
        list-style-type: none;
        border:1px solid rgb(40,167,69);
        border-radius: 5px;
        display : inline-block;
        padding: 10px 10px;
        transition: all .2s ease-in-out;
        cursor: pointer;
    }
    .tabs ul li:first-child {
        margin-left: 0;
    }
    .tabs ul {

    }
    .tabs ul li a {
        font-size: 18px;
        font-weight: bold;
        color: rgb(40,167,69);
    }
    .tabs ul li:hover,  .tabs ul li.active{
        background-color: rgb(40,167,69);
    }
    .tabs ul li:hover a, .tabs ul li.active a{
        color: #fff;
        text-decoration: none;
    }
</style>

<script>
    export default {
        data() {
            return {
                totalUsers: 0,
                perPage: 3,
                currentPage:1,
                users: [],
                allUsersActive: true,
                onlineUsersActive: false,
                chunkedOnlineUsers: [],
                currentOnlinePage:1
            };
        },
        mounted() {
          this.$on('check', this.checkOnline());
        },
        props: ['asset', 'defaultImage', 'messageUrl', 'onlineUsers', 'allOnlineUsers'],
        methods: {
            makeAllUsersActive() {
                this.allUsersActive = true;
                this.onlineUsersActive = false;
            },
            makeOnlineUsersActive() {
                this.allUsersActive = false;
                this.onlineUsersActive = true;
            },
            getOnlineUsers(page) {
                this.chunkedOnlineUsers = [];
                var end = this.perPage * page - 1;
                var begin = end - (this.perPage - 1);
                console.log(begin + "-" + end);
                var counter = 0;
                this.allOnlineUsers.forEach((user, index) => {
                    if (index >= begin && index <= end) {
                        this.chunkedOnlineUsers.push(user);
                    }
                    counter++;
                    if (counter >= this.perPage) {
                        return true;
                    }
                });
                this.currentOnlinePage = page;

                $('.image-error').on('error', (e) => {
                    $('.image-error.invalid').attr('src', this.defaultImage);
                });
            },
            getUsers: function (page) {
                axios.post('/users',{page:page}).then(res => {
                    this.users = res.data.users;
                    this.users.forEach((user) => {
                        this.isOnline(user);
                    });
                    this.totalUsers = res.data.totalUsers;

                    this.currentPage = page;

                    $('.image-error').on('error', (e) => {
                        $('.image-error.invalid').attr('src', this.defaultImage);
                    });
                });
            },
            renderImage(user) {
                if (user.img) {
                    return this.asset + '/' + user.img;
                }
                return this.defaultImage;
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
            checkOnline: function () {
                this.users.forEach((user) => {
                    this.isOnline(user);
                });
            }
        },
        created: function () {
            this.getUsers(this.currentPage);
        }
    }
</script>
