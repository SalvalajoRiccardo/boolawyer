<template>
  <footer class="bg-secondary py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- LOGO -->
      <div class="logo_box_footer">
        <router-link class="navbar-brand" :to="{name:'home'}">
          <img :src="'/images/logo.png'" alt="logo Boolawyer"
            title="Clicca qui per tornare alla home"> 
        </router-link>
      </div>

      <ul class="nav footer-nav">
        <li class="nav-item">
          <router-link :to="{name:'home'}" class="nav-link active" aria-current="page" href="#">Home</router-link>
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

<style lang="scss">
  $lawblue: #2c4065;
  $lawbronze: #b69d73;
  $lawred: #83354c;
  $notwhite: #ddd;


  .footer-nav li>a {
    color: rgba(0, 0, 0, 0.5);
    font-size: 1.2rem;
    font-weight: 300;

    &:hover {
      color: #000;
    }
  }

  .logo_box_footer{
    filter: brightness(0);
    & img{
      max-height: 2rem;
    }
  }
  
</style>