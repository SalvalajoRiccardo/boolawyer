<template>
  <main>
    <div class="container py-4">
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
}

</style>