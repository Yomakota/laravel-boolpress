<template>
  <header class="text-center p-2">
    <nav class="navbar-expand-lg bg-transparent">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <ul class="navbar-nav">
              <li
                v-for="(link, index) in header_links"
                :key="index"
                class="nav-item"
              >
                <router-link
                  :to="{ name: link.name }"
                  class="nav-link text-uppercase"
                  >{{ link.label }}</router-link
                >
              </li>
            </ul>
          </div>
          <div class="col-2">
            <a class="btn btn-primary" href="/admin">Private session</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      header_links: [
        {
          name: "home",
          label: "Home",
        },
        {
          name: "about",
          label: "About",
        },
        {
          name: "blog",
          label: "Blog",
        },
        {
          name: "contact",
          label: "Contact us",
        },
      ],
    };
  },
};
</script>

<style lang="scss">
header {
  background-color: lightcoral;
}
</style>