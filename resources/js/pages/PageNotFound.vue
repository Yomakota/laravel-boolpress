<template>
  <div class="container">
    <h1>Not Found</h1>
    <div>
      <span
        >Back to our
        <router-link :to="{ name: 'blog' }">Blog</router-link></span
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "PageNotFound",
};
</script>