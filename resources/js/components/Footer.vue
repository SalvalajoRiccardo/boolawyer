<template>
  <footer class="bg-secondary py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- LOGO -->
      <div class="logo_box">
        <router-link class="navbar-brand" :to="{name:'home'}">
          LOGO
        </router-link>
      </div>

      <ul class="nav">
        <li class="nav-item">
          <router-link :to="{name:'home'}" class="nav-link active" aria-current="page" href="#">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name:'lawyers'}" class="nav-link" href="#">Lawyers</router-link>
        </li>
      </ul>

      <h6>&#169; Copyright, 2021</h6>

    </div>
  </footer>
</template>

<script>
export default {
  name:'Footer'

}
</script>

<style>

</style>