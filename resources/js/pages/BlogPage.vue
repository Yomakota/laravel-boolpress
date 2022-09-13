<template>
  <div>
    <div class="container">
      <h2>Blog</h2>
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
