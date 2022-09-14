<template>
  <div class="container mt-5">
    <div v-if="post">
      <div>
        <h1>{{ post.title }}</h1>
      </div>
      <div v-if="post.tags.length > 0">
        <ul class="list-unstyled">
          <li
            v-for="tag in post.tags"
            :key="tag.id"
            class="badge rounded-pill bg-success mr-2"
          >
            <span>
              {{ tag.name }}
            </span>
          </li>
        </ul>
      </div>
      <div v-if="post.category">
        <strong>Category:</strong> {{ post.category.name }}
      </div>
      <div class="mt-3">
        <p>{{ post.content }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Product",
  data() {
    return {
      api_url: "/api/posts/",
      post: null,
    };
  },
  methods: {
    getProduct() {
      axios
        .get(`${this.api_url}${this.$route.params.slug}`)
        .then((response) => {
          this.post = response.data.results;
        });
    },
  },
  mounted() {
    this.getProduct();
  },
};
</script>

<style lang="scss" scoped>
span {
  font-size: 15px;
  padding: 10px;
}
</style>