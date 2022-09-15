<template>
  <div class="card h-100">
    <img
      v-if="post.cover"
      :src="post.cover"
      :alt="post.title"
      class="card-img-top"
    />
    <img
      v-else
      src="img/laravel-image.png"
      alt="laravel-logo"
      class="card-img-top"
    />
    <div class="card-body">
      <h5 class="card-title">{{ post.title }}</h5>
      <p class="card-text">
        {{ truncateText(post.content) }}
      </p>
      <router-link
        class="btn btn-primary"
        :to="{ name: 'product', params: { slug: post.slug } }"
      >
        Read
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    post: Object,
  },
  methods: {
    truncateText(text) {
      if (text.length > 75) {
        return text.slice(0, 75) + "...";
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.card-img-top {
  height: 300px;
  object-fit: cover;
}
</style>