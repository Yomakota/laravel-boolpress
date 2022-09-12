<template>
  <div>
    <header>
      <HeaderPage />
    </header>
    <main>
      <Nav />
      <Posts />
    </main>
  </div>
</template>

<script>
import HeaderPage from "../components/HeaderPage.vue";
import Posts from "../components/Posts.vue";
import Nav from "../components/Nav.vue";

export default {
  name: "App",
  components: {
    HeaderPage,
    Posts,
    Nav,
  },
};
</script>

<style lang="scss">
header {
  background-color: lightcoral;
  padding: 1em;
}
</style>
