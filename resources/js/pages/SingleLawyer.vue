<template>
    <div class="container mt-3">
      <!-- start Card -->
      <div class="card mb-3" >
        <div class="row g-0">
          <div class="col-md-4">
             <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name" class="img-fluid rounded-start">
          </div>
          <div class="col-md-8">
            <div class="card-body p-0">
              <h5 class="card-title card-header"> {{ lawyer.name }}  {{ lawyer.surname }}</h5>
              <p class="card-text p-4"> {{ lawyer.services }}</p>
               <!-- SPECIALIZATIONS -->
                <div  v-if="lawyer.specializations">
                  <span v-for="(specialization,index) in lawyer.specializations" :key="index" class="badge badge-dark mx-4">{{specialization.name}}</span>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end Card -->
      <MessageForm :id="lawyer.id" />


    </div>
</template>

<script>
import MessageForm from '../components/MessageForm.vue'

export default {
    name: "SingleLawyer",
    components: {
      MessageForm
    },
    data() {
      return {
        lawyer: [],
    
        
      }
    },
    mounted(){
      // console.log(this.$route.params.slug);
      axios.get('/api/user/'+ this.$route.params.slug)
        .then( response => {
          this.lawyer = response.data.results;
          // console.log(this.lawyer);
        } )
        .catch(error => {
          console.log(error);
        });

    },
    methods:{
   
  }

};
</script>

<style>

</style>