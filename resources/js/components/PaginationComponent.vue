<template>
    <section class="pagination">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul>
                        <li v-if="hasPrev()">
                            <a href="#" @click="changePage(prevPage)">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <li v-if="hasFirst()">
                            <a href="#" @click="changePage(1)">1</a>
                        </li>
                        <li v-if="hasFirst()">
                            ...
                        </li>
                        <li v-for="page in pages">
                            <a href="#" @click="changePage(page)" :class="{active: current == page}">{{page}}</a>
                        </li>
                        <li v-if="hasLast()">
                            ...
                        </li>
                        <li v-if="hasLast()">
                            <a href="#" @click="changePage(totalPages)">{{totalPages}}</a>
                        </li>
                        <li v-if="hasNext()">
                            <a href="#" @click="changePage(nextPage)">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            current: {
                type: Number,
                default: 1
            },
            total: {
                type: Number,
                default: 0
            },
            perPage: {
                type: Number,
                default: 3
            },
            pageRange: {
                type: Number,
                default: 2
            }
        },
        computed: {
            pages: function () {
                var pages = [];

                for (var i = this.rangeStart; i <= this.rangeEnd; i++) {
                    pages.push(i);
                }
                return pages;
            },
            rangeStart: function () {
              var start = this.current - this.pageRange;
              if (start > 0) {
                  return start;
              } else {
                  return 1;
              }
            },
            rangeEnd: function () {
                var end = this.current + this.pageRange;
              if (end < this.totalPages) {
                  return end;
              } else {
                  return this.totalPages;
              }
            },
            totalPages: function () {
              return Math.ceil(this.total / this.perPage);
            },
            nextPage: function () {
                return this.current + 1;
            },
            prevPage: function () {
                return this.current - 1;
            }
        },
        methods: {
            hasFirst: function () {
                return this.rangeStart !== 1;
            },
            hasLast: function () {
                return this.rangeEnd < this.totalPages;
            },
            hasPrev: function () {
                return this.current > 1;
            },
            hasNext: function () {
                return this.current < this.totalPages;
            },
            changePage: function (page) {
                this.$emit('page-changed', page);
            }
        }
    }
</script>