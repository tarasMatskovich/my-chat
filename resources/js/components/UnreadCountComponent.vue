<template>
    <span class="unread-count text-danger" v-if="unreadCount > 0"> (+{{unreadCount}})</span>
</template>

<style>

</style>

<script>
    export default {
        data() {
            return {

            }
        },
        props: ['unreadCount'],
        created: function () {

        }
    }
</script>