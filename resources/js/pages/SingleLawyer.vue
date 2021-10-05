<template>
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header"> {{ lawyer.name }}  {{ lawyer.surname }}</h5>
            <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name" class="card-img-top">
            <div class="card-body">
                <!-- SPECIALIZATIONS -->
                <div  v-if="lawyer.specializations">
                  <span v-for="(specialization,index) in lawyer.specializations" :key="index">{{specialization.name}}</span>
                </div>
                <p class="card-text"> {{ lawyer.services }}</p>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "SingleLawyer",
    components: {
      
    },
    data() {
      return {
        lawyer: []
      }
    },
    mounted(){
      // console.log(this.$route.params.slug);
      axios.get('/api/user/'+ this.$route.params.slug)
        .then( response => {
          this.lawyer = response.data.results;
          console.log(this.lawyer);
        } )
        .catch(error => {
          console.log(error);
        });

    }
};
</script>

<style>

</style>