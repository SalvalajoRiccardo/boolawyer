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

              <!-- Parte nome e cognome -->
              <h5 class="card-title card-header"> {{ lawyer.name }}  {{ lawyer.surname }}</h5>

              <!-- parte dell'address -->
              <small class="card-text p-4 d-block">address: {{ lawyer.address }}</small>

              <!-- parte del phone -->
              <small v-if="lawyer.phone" class="card-text px-4 d-block">phone: {{ lawyer.phone }}</small>
              <small v-else class="d-block m-4">phone: L'utente non ha ancora aggiunto il suo numero di cellulare, <br> invia un messaggio per richiedere ulteriori informazioni</small>
              

              <!-- parte dei services -->
              <p v-if="lawyer.services" class="card-text p-4"> {{ lawyer.services }}</p>
              <small v-else class="d-block m-4">services: L'utente non ha ancora aggiunto le sue prestazioni, <br> invia un messaggio per richiedere ulteriori informazioni</small>

               <!-- SPECIALIZATIONS -->
                <div  v-if="lawyer.specializations">
                  <span v-for="(specialization,index) in lawyer.specializations" :key="index" class="badge badge-dark mx-4">{{specialization.name}}</span>
                </div>
                <!-- Button trigger modal - Parte del CV  -->
                <button v-if="lawyer.cv" type="button" class="btn btn-primary m-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Visualizza CV
                </button>

                <small v-else class="d-block m-4">CV: L'utente non ha ancora aggiunto il suo CV, <br> invia un messaggio per richiedere ulteriori informazioni</small>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
                        <h5 class="modal-title" id="exampleModalLabel">CV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <img v-if="lawyer.cv" :src="lawyer.cv" class="card-img-top">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                  
            </div>
          </div>
        </div>
      </div>
      <!-- end Card -->

      <!-- MESSAGE FORM -->
      <MessageForm :id="lawyer.id" />

      <!-- REVIEW FORM -->
      <ReviewForm :id="lawyer.id" />


    </div>
</template>

<script>
import MessageForm from '../components/MessageForm.vue';
import ReviewForm from '../components/ReviewForm.vue'

export default {
    name: "SingleLawyer",
    components: {
      MessageForm,
      ReviewForm
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