<template>
  <main>
    <HeaderPage />
    <Posts />
  </main>
</template>

<script>
import HeaderPage from "../components/HeaderPage.vue";
import Posts from "../components/Posts.vue";

export default {
  name: "App",
  components: {
    HeaderPage,
    Posts,
  },
};
</script>

<style lang="scss">
</style>
