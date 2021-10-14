<template>
  <section>
  
    <div class="container first_container">
      <div class="row justify-content-center justify-content-md-center">
        <div id="welcome-text" class="col-12 col-md-6 pippo text-center d-flex flex-column justify-content-center">
          <span class="span_text my-2">Consulenza Legale</span>
          <h2 class="h2_text_light">Se hai un problema legale nella tua vita,</h2>
          <h3 class="h3_text">noi siamo disponibili</h3>
        </div>
      </div>

    </div>

    <!-- MEDICI IN EVIDENZA -->
    <div class="wrapper text-center">

      <span class="span_text_carousel text-center">AVVOCATI IN EVIDENZA</span>
      
      <!-- Carousel -->
      <agile :key="lawyers.length" :slidesToShow="1" :dots="false" :infinite="false"  :navButtons="false" ref="carousel" :options="myOptions">
        <div class="slide card my-3 p-3 text-center" v-for="(lawyer,index) in filteredLawyers" :key="index">
          
          <!-- IMG -->
          <div class="rounded-circle overflow-hidden m-auto img_box" style="width:150px; height:150px;">
            <img v-if="lawyer.photo" :src="`http://localhost:8000/storage/` + lawyer.photo" :alt="lawyer.name" class="img-fluid" :title="lawyer.name">
            <img  v-else src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle m-auto" width="150">
          </div>
          <img >
          <!-- Card Body -->
          <div class="my_card-body pb-3">
            <!-- Movies name -->
            <h4>{{ lawyer.name }} {{lawyer.surname}}</h4>
            <router-link :to="{name: 'lawyer-detail', params: { slug: lawyer.slug }}" class="btn btn-bronze">
              Dettagli
            </router-link>

          </div> 

        </div>
      </agile>

      <!-- LEFT button -->
      <button class="button btn_prev" @click="$refs.carousel.goToPrev()"><i class="bi bi-chevron-left"></i></button>
      <!-- RIGHT button -->
      <button class="button btn_next" @click="$refs.carousel.goToNext()"><i class="bi bi-chevron-right"></i></button> 

    </div>

    <div class="container about_container py-5 rounded mt-3 mb-5">
    <!-- ABOUT SECTION -->
      <div class="row align-items-center">
        <div class="col-12 col-md-8 px-5 ">
            <span class="span_text">Chi siamo</span>
            <h2 class="h2_text_dark">Siamo qui per combattere qualsiasi violazione con esperienza</h2>
            <p class="p_text">Invia la tua richiesta agli avvocati giusti per aiutarti. Selezionati per la loro esperienza, gli avvocati ti contatteranno direttamente per organizzare un incontro e risolvere il tuo problema. Tutti gli avvocati della nostra rete sono altamente classificati ed appartengonoa studi legali indipendenti quali, Legal 500 e Chambers and Partners.</p>
        </div>
        <div class="col-12 col-md-4 justice_box text-center">
            <img :src="'/images/justice.png'" alt="justice statue">
        </div>

      </div>
      <!-- BUTTONS FOR ALL THE SPECIALIZATIONS -->
      <div class="row">
        <div class="col-12 col-md-8 px-5">
          <span class="span_text">Cosa Facciamo</span>
          <h5 class="my-2">Inizia la ricerca, scegliendo una Specializzazione</h5>
        </div>
      </div>
      <div class="row justify-content-center my-3">
        
        <router-link 
          :to="{name:'lawyers', params:{id: item.id}}" 
          v-for="(item,index) in specializationsArray" :key="index"
          class="btn btn-blue mx-2 mt-4"> 
          {{item.name}}
        </router-link>

      </div>
    </div>
  
      


    <!-- <div class="row" v-for="(lawyer,index) in lawyers" :key="index">
        <h2 class="text-white" v-if="lawyer.sponsors.length >= 1">{{lawyer.slug}}</h2>
    </div> -->

  
  </section>
</template>

<script>
import { VueAgile } from 'vue-agile';
export default {
  name:'Home',
  components:{
    agile: VueAgile,
  },
  data(){
    return{
      url:'http://localhost:8000/api/users',
      lawyers:[],
      urlSpec:'http://localhost:8000/api/specializations',
      specializationsArray:[],
      selectedSpec: null,
      myOptions: {

        responsive: [
          {
            breakpoint: 500,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 3
            }
          },
          
        ]
      }

    }
  },

  computed : {
    filteredLawyers : function (){
      return this.lawyers.filter((element)=>{
         return element.sponsors.length >= 1;
      });
    }
  },

  
  created(){
    // this.getUsers(1,this.selectedSpec, this.orderByNum, this.orderByVote);
    this.getSpecs();
    this.getSponsored();
    

  },

  methods:{
    // Get all the lawyers from the PI
    getSpecs(){
      axios
      .get(this.urlSpec)
      .then(response=>{
        this.specializationsArray = response.data.results;          
        // console.log(this.specializationsArray);
      })
    },
    getSponsored(){
      axios
      .get(this.url)
      .then(response=>{
         this.lawyers = response.data.results1;         
        console.log(this.lawyers);
      })
    },
  }

}
</script>

<style lang="scss">

  // Colors
  $lawblue: #2c4065;
  $lawbronze: #b69d73;
  $lawred: #83354c;
  $notwhite: #ddd;

  /* Typography */
  .span_text{
    text-transform:uppercase;
    color: #b69d73;
    font-weight:bold;
    font-size: 20px;
  }

  .span_text_carousel{
    text-transform:uppercase;
    color: white;
    font-weight:bold;
    font-size: 24px;
    text-shadow: 
        1.25px 1.25px  #2c4065,
        1px 1px        #2c4065,
        0.75px 0.75px  #2c4065,
        0.5px 0.5px    #2c4065,
        0.25px 0.25px  #2c4065;
  }

  .h2_text_light{
    color:$notwhite;
    font-weight:bold;
    font-size: 40px;
    width:80%;
    margin: 0 auto;
  }

  .h2_text_dark{
    color:$lawblue;
  }

  .h3_text{
    font-style: italic;
    color:$lawbronze;
    font-weight:bold;
    font-size: 36px;
  }

  .p_text{
    font-size: 16px;
    letter-spacing: 1px;
    line-height: 26px;
    color:#000223
  }

  #welcome-text {
    animation: slideInBelow 2s ease-out;
  }

  // Animations
  @keyframes slideInLeft {

    0% {opacity: 0;
        transform: translateX(-70px);}

    100% {opacity: 1;
        transform: translateX(0);}
  }

  @keyframes slideInRight {

    0% {opacity: 0;
        transform: translateX(50px);}

    // 95% {opacity: 1;
    //     transform: translateX(-5px);}

    100% {opacity: 1;
        transform: translateX(0);}
  }

  @keyframes slideInBelow {

    0% {opacity: 0;
        scale: 0;
        transform: translateY(50px);}

    100% {opacity: 1;
          scale: 1;
          transform: translateY(0);}
  }

  body {
    background-image: 
    linear-gradient(to right, 
      rgba(44, 64, 101, 0.4) 0%,
      rgba(182,157,115,0.4) 100%),
    url('/images/pexels-photo-8755742.jpeg');
    background-size: cover;
    background-position: top;
    font-family: "Times New Roman", Times, serif;
  }

  .btn-blue {
    background-color: $lawblue;
    color: $notwhite;
    font-size: 1.3rem;
    transition: all .8s;

    &:hover{
      background-color: $lawblue;
      color: $notwhite;
      transform: scale(1.1);
      z-index: 1;
    }
  }

  .btn-bronze {
    background-color: rgba(182, 158, 115, 0.9);
    color: $lawblue;
    font-size: 1rem;
    font-weight: 600 !important;
    transition: all .8s;

    &:hover{
      background-color: $lawbronze;
      color: $lawblue;
      transform: scale(1.1);
      z-index: 1;
    }
  }

  .first_container{
    height: 500px;
    .pippo{
      height: 500px;
    }
  }
  .wrapper{
    position: relative;
    
    .slide {
      height: 275px;
      position: relative;
      margin: 0 5px;
      background-color: rgba(221, 221, 221,0.5);


      .my_card-body {
        text-align: center;
        width: 100%;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);

        h4 {
          color: $lawblue;
          font-size: 1.5rem;
          font-weight: 800;
          letter-spacing: 2px;
        }

      }

      .img_box{
        background-color: white;
        img {
        width: 100%;
      }
      }
    }

    .button{
      background-color: white;
      width:50px;
      height: 50px;
      border-radius: 50% ;
      position: absolute;
      top: 50%;
      right:1%;
      opacity:0.6;
      &:hover{
        cursor: pointer;
        opacity:1
      }
        
    }
    .btn_prev{
      left:-8%;
    }
    .btn_next{
      right: -8%;
    }
  }

  .about_container{
    background-color: rgba(221, 221, 221,0.9);

    .justice_box{
        height:300px;
        img{
            height: 100%;
        }
    }
}
</style>