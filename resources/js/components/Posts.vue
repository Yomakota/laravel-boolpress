<template>
  <section>
    <div class="container mt-4">
      <h1 class="text-center">Our Posts</h1>
      <div class="row row-cols-3">
        <div v-for="post in posts" :key="post.id" class="col mt-3">
          <div class="card h-100">
            <!-- <img src="" class="card-img-top" alt="" /> -->
            <div class="card-body">
              <h5 class="card-title">{{ post.title }}</h5>
              <p class="card-text">
                {{ truncateText(post.content) }}
              </p>
              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
          </div>
        </div>
      </div>

      <nav class="mt-4">
        <ul class="pagination">
          <li class="page-item" :class="{ disabled: currentPage == 1 }">
            <a
              class="page-link"
              href="#"
              @click.prevent="getPosts(currentPage - 1)"
            >
              Previous
            </a>
          </li>
          <li class="page-item" :class="{ disabled: currentPage == lastPage }">
            <a
              class="page-link"
              href="#"
              @click.prevent="getPosts(currentPage + 1)"
            >
              Next
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </section>
</template>

<script>
export default {
  name: "Posts",
  data() {
    return {
      posts: [],
      currentPage: 1,
      lastPage: null,
    };
  },
  methods: {
    truncateText(text) {
      if (text.length > 75) {
        return text.slice(0, 75) + "...";
      }
    },
    getPosts(pageNum) {
      axios
        .get("/api/posts", {
          params: {
            page: pageNum,
          },
        })
        .then((response) => {
          this.posts = response.data.results.data;
          this.currentPage = response.data.results.current_page;
          this.lastPage = response.data.results.last_page;
        });
    },
  },
  mounted() {
    this.getPosts(1);
  },
};
</script>
