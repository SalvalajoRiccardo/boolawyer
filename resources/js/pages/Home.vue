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
      <div v-for="(lawyer,index) in lawyers" :key="index">
        <h2 v-if="lawyer.sponsors.length >= 1">{{lawyer.slug}}</h2>
      </div>

  </section>
</template>

<script>
export default {
  name:'Home',
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
</style>