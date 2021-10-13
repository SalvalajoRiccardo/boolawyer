<template>
  <section>
    

    <!-- BUTTONS FOR ALL THE SPECIALIZATIONS -->
    <div class="row justify-content-center my-3">
     
      <router-link 
        :to="{name:'lawyers', params:{id: item.id}}" 
        v-for="(item,index) in specializationsArray" :key="index"
        class="btn btn-blue mx-2 mt-4"> 
        {{item.name}}
      </router-link>

    </div>

    <!-- <div class="row" v-for="(lawyer,index) in lawyers" :key="index">
        <h2 class="text-white" v-if="lawyer.sponsors.length >= 1">{{lawyer.slug}}</h2>
    </div> -->

    <div class="wrapper">

      <!-- Carousel -->
      <agile :key="lawyers.length" :slidesToShow="3" :dots="false" :infinite="false"  :navButtons="false" ref="carousel">
        <div class="slide card" v-for="(el,index) in lawyers" :key="index">

          <!-- IMG -->
          <img :src="`http://localhost:8000/storage/` + el.photo" :alt="el.name">
          <!-- Card Body -->
          <div class="card-body">

            
            <!-- Movies name -->
            <h4 class="card-title">{{el.name}}</h4>

          </div> 

        </div>
      </agile>

      <!-- LEFT button -->
      <button class="btn btn_prev" @click="$refs.carousel.goToPrev()"><i class="bi bi-chevron-left"></i></button>
      <!-- RIGHT button -->
      <button class="btn btn_next" @click="$refs.carousel.goToNext()"><i class="bi bi-chevron-right"></i></button> 

    </div>

  </section>
</template>

<script>
import { VueAgile } from 'vue-agile';
export default {
  name:'Home',
  components:{
      agile: VueAgile 
    },
  data(){
    return{
      url:'http://localhost:8000/api/users',
      lawyers:[],
      urlSpec:'http://localhost:8000/api/specializations',
      specializationsArray:[],
      selectedSpec: null,

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

  body {
    background-image: 
    linear-gradient(to right, 
      rgba(44, 64, 101, 0.3) 0%,
      rgba(182,157,115,0.3) 100%),
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

  @media screen and (max-width: 600px) {
    .card-body {
      display: none;
    }
  }

  .wrapper{
    position: relative;
    
    .slide {
      height: 255px;
      position: relative;
      margin: 0 5px;

      @media screen and (max-width: 600px){
        height: 150px;
      }

      .card-body {
        text-align: center;
        width: 100%;
        background-color: $notwhite;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
      }

      img {
        width: 100%;
      }
    }

    .btn{
      background-color: white;
      width:50px;
      height: 50px;
      border-radius: 50% ;
      position: absolute;
      top: 30%;
      right:1%;
      opacity:0.6;
      &:hover{
        cursor: pointer;
        opacity:1
      }
        
    }
    .btn_prev{
      left:-10%;
    }
    .btn_next{
      right: -10%;
    }
  }
</style>