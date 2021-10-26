<template>
  <section id="post-list">
    <h2>I miei post</h2>
    <Loader v-if="isLoading" />
    <div v-else>
      <Pagination
        :lastPage="pagination.lastPage"
        :currentPage="pagination.currentPage"
        @onPageChange="changePage"
      />
      <PostCard v-for="post in posts" :key="post.id" :post="post" />
      <Pagination
        :lastPage="pagination.lastPage"
        :currentPage="pagination.currentPage"
        @onPageChange="changePage"
      />
    </div>
  </section>
</template>

<script>
// import axios from 'axios';
import Loader from "../Loader.vue";
import PostCard from "./PostCard.vue";
import Pagination from "../Pagination.vue";
export default {
  name: "PostList",
  components: {
    Loader,
    PostCard,
    Pagination,
  },
  data() {
    return {
      baseUri: "http://localhost:8000",
      posts: [],
      isLoading: false,
      pagination: {},
      order: "desc",
    };
  },
  methods: {
    getPosts(page) {
      this.isLoading = true;
      axios
        .get(`${this.baseUri}/api/posts?page=${page}&order=${this.order}`)
        .then((res) => {
          // console.log(res.data);
          // DESTRUCTURING
          const { data, current_page, last_page } = res.data;

          this.posts = data;
          this.pagination = { currentPage: current_page, lastPage: last_page };
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },

    changePage(page) {
      this.getPosts(page);
    },
  },
  created() {
    this.getPosts();
  },
};
</script>


