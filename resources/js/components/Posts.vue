<template>
  <section>
    <h1 class="bg-info text-center p-3">Our Posts</h1>
    <div class="container mt-4">
      <div class="row row-cols-3">
        <div class="col mt-3" v-for="post in posts" :key="post.id">
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

      <div class="row">
        <div class="col-12">
          <nav class="mt-4">
            <ul class="pagination justify-content-center">
              <!--Previous btn -->
              <li class="page-item" :class="{ disabled: currentPage == 1 }">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="getPosts(currentPage - 1)"
                >
                  Previous
                </a>
              </li>
              <!-- Page numbers btn -->
              <li
                v-for="pageNum in lastPage"
                :key="pageNum"
                class="page-item"
                :class="{ active: pageNum == currentPage }"
              >
                <a @click="getPosts(pageNum)" class="page-link" href="#">
                  {{ pageNum }}
                </a>
              </li>
              <!--Next btn -->
              <li
                class="page-item"
                :class="{ disabled: currentPage == lastPage }"
              >
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
      </div>
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
