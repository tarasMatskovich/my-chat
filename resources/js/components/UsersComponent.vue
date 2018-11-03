<template>
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
                                <a href="message.html" class="write-msg">Написать сообщение</a>
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
    <h5 v-else>Пользователей, пока нет</h5>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                totalUsers: 0,
                perPage: 3,
                currentPage:1,
                onlineUsers: []
            };
        },
        props: ['asset', 'defaultImage'],
        methods: {
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
                        this.onlineUsers.push({
                            id:user.id
                        });
                    });
                    this.getUsers(this.currentPage);
                    // this.users.forEach((user) => {
                    //     users.forEach((onlineUser) => {
                    //         if (user.id == onlineUser) {
                    //             user.online = true;
                    //         }
                    //     });
                    // });



                    // users.forEach((user) => {
                    //     this.onlineUsers[user.id] = user.id;
                    // });
                })
                .joining((user) => {
                    this.onlineUsers.push({
                        id:user.id
                    });
                    this.users.forEach((user) => {
                        this.isOnline(user);
                    });
                    // this.onlineUsers[user.id] = user.id;

                    // this.users.forEach((existingUser) => {
                    //     if (existingUser.id == user.id) {
                    //         existingUser.online = true;
                    //     }
                    // })
                })
                .leaving((user) => {
                    this.onlineUsers.forEach((onlineUser,index) => {
                        if (onlineUser.id == user.id) {
                            this.onlineUsers.splice(index, 1);
                        }
                    });
                    this.users.forEach((user) => {
                        this.isOnline(user);
                    });
                    // this.users.forEach((existingUser) => {
                    //     if (existingUser.id == user.id) {
                    //         existingUser.online = false;
                    //     }
                    // })


                    // let index = this.onlineUsers.indexOf(user.id);
                    // if (index > -1) {
                    //     this.onlineUsers.splice(index, 1);
                    // }
                });
        }
    }
</script>
