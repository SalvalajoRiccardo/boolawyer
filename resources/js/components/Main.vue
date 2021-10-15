<template>
  <main>
    <div class="container">
      <router-view></router-view>
    </div>
  </main>
</template>

<script>
export default {
  name:'Main'
}
</script>

<style lang="scss" scoped>
main{
  min-height: calc(100vh - 100px);
  
    background-image: 
    linear-gradient(to right, 
      rgba(44, 64, 101, 0.4) 0%,
      rgba(182,157,115,0.4) 100%),
    url('/images/pexels-photo-8755742.jpeg');
    background-size: cover;
    background-position: top;
    font-family: "Times New Roman", Times, serif;
    overflow: hidden;
  
}

</style>