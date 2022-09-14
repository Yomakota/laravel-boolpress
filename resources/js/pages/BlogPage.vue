<template>
  <div>
    <div class="container text-center">
      <h1>Blog</h1>
    </div>
    <Posts />
  </div>
</template>

<script>
import Posts from "../components/Posts.vue";

export default {
  name: "BlogPage",
  components: {
    Posts,
  },
};
</script>
