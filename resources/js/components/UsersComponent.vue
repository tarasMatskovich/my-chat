<template>
    <div v-if="this.users.length > 0" class="users">
        <div v-for="user in users" class="user">
            <div class="row">
                <div class="col-md-2">
                    <div class="img-wrapp">
                        <a href="#">
                            <img :src="renderImage(user)" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <div class="users-info">
                                <h5>
                                    <a href="#" class="name">
                                        {{user.first_name}} {{user.last_name}}
                                    </a>
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
                currentPage:1
            };
        },
        props: ['asset', 'defaultImage'],
        methods: {
            getUsers: function (page) {
                axios.post('/users',{page:page}).then(res => {
                    this.users = res.data.users;
                    this.totalUsers = res.data.totalUsers;

                    this.currentPage = page;
                });
            },
            renderImage(user) {
                if (user.img) {
                    return this.asset + '/' + user.img;
                }
                return this.defaultImage;
            }
        },
        created: function () {
            this.getUsers(this.currentPage);
        }
    }
</script>
