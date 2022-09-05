<template>
  <header class="header p-3">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6">
          <a href="/admin" class="btn btn-outline-primary">Private session</a>
        </div>
        <div class="col-6">
          <h1>Public Home</h1>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: "HeaderPage",
};
</script>

<style lang="scss">
.header {
  background-color: lightcoral;
}
</style>