
<template>
  <div>
      <Header/>
      <Main/>
      <Footer/>
  </div>
</template>

<script>
import Header from '../components/Header.vue';
import Main from '../components/Main.vue';
import Footer from '../components/Footer.vue';
export default {
    name:'App',
    components:{
        Header,
        Main,
        Footer
    }
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>