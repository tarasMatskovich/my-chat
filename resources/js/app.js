
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
    el: '#app'
});
