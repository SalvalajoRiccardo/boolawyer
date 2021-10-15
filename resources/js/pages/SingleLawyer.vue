<template>
    <div class="container mt-3">

    <!-- START CARD -->
    <div class="card">

      <!-- start row -->
      <div class="row">

        <!-- start left column -->
        <div class="col-12 col-md-6 col-lg-4 my_img_box text-center p-0">
          <!-- IMAGE PROFILE -->
          <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name">

        </div>
        <!-- end left column -->

        <!-- start right column -->
        <div class="col-12 col-md-6 col-lg-8 my_card_body p-0">

          <!-- Parte nome e cognome -->
          <h5 class="card-title card-header my_card_header rounded-start"> {{ lawyer.name }} {{ lawyer.surname }}</h5>

          <!-- parte dell'address -->
          <p class="card-text pt-4 px-4 d-block text-truncate"><i class="bi bi-house-door"></i> : {{ lawyer.address }}</p>

          <!-- parte del phone -->
          <p v-if="lawyer.phone" class="card-text px-4 d-block"><i class="bi bi-telephone"></i> : {{ lawyer.phone }}</p>
          <small v-else class="d-block m-4">phone: L'utente non ha ancora aggiunto il suo numero di cellulare, <br> invia un messaggio per richiedere ulteriori informazioni</small>

          <!-- parte della email -->
          <p class="card-text px-4 d-block"><i class="bi bi-envelope"></i> : {{ lawyer.email }}</p>
            
          <!-- parte dei services -->
          <p v-if="lawyer.services" class="card-text px-4"> {{ lawyer.services }}</p>
          <small v-else class="d-block m-4">services: L'utente non ha ancora aggiunto le sue prestazioni, <br> invia un messaggio per richiedere ulteriori informazioni</small>

          <!-- SPECIALIZATIONS -->
          <div  v-if="lawyer.specializations" class="pl-4">
            <h4 v-for="(specialization,index) in lawyer.specializations" :key="index" class="badge rounded-pill mx-3">{{specialization.name}}</h4>
          </div>

          <!-- Button trigger modal - Parte del CV  -->
          <button v-if="lawyer.cv" type="button" class="btn btn-blue m-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Visualizza CV
          </button>

          <small v-else class="d-block m-4">CV: L'utente non ha ancora aggiunto il suo CV, invia un messaggio per richiedere ulteriori informazioni</small>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">    
                  <h5 class="modal-title" id="exampleModalLabel">{{lawyer.name + " " + lawyer.surname}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
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
        <!-- end right column -->

      </div>
      <!-- end row -->

    </div>
    <!-- END CARD -->

    <div class="forms">
      <!-- MESSAGE FORM -->
      <MessageForm :id="lawyer.id" />

      <!-- REVIEW FORM -->
      <ReviewForm :id="lawyer.id" />
    </div>


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

<style lang="scss" scoped>
// Colors
  $lawblue: #2c4065;
  $lawbronze: #b69d73;
  $lawred: #83354c;
  $notwhite: #ddd;

  .my_img_box{

    background-color: #ddd;
    height:420px;
    overflow: hidden;
    img{
      height: 100%;
    }
  }

  .my_card_header{
    background-color:rgb(102, 102, 102) ;
  }

  .my_card_body{
    background-color: rgba(141, 141, 141, 0.8);
    max-height: 420px;
  }

  .card{
    /* background-color: rgba(119, 119, 119, 0.8); */
    border:none;
    color: #ddd;
    overflow: hidden;

    & h5 {
      color: $lawbronze;
      font-weight: 600;
      letter-spacing: 2px;
    }

    & .rounded-pill {
      background-color: $lawblue;
      padding: 8px;
    }

    & .modal h5 {
      color: $lawblue;
    }
  }

  .forms {
    padding: 50px 0;
  }
</style>