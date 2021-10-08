<template>
  <div class="container">
    <!-- <Search/> -->

    <div class="types">
      <button :class="item" v-for="(item,index) in specializationsArray" :key="'a'+ index" @change="getUsers(1, selectedSpec)">
          <input type="radio" :id="'a' + index" :value="item.id" v-model="selectedSpec" name="specializations">
          <label :for="'a' + index">{{item.name}}</label>
      </button>
    </div>

    <div v-if="selectedSpec">
      <!-- BUTTON ORDER BY NUMBER -->
      <button class="btn btn-primary" @click="getUsers(1, selectedSpec,orderByNum==true,orderByVote)">
        order by number of reviews
      </button>

    <!-- BUTTON ORDER BY VOTE -->
      <button class="btn btn-primary" @click="getUsers(1, selectedSpec,orderByNum, orderByVote==true)">
      order by vote of reviews
      </button>
    </div>
   

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col" v-for="lawyer in lawyers" :key='lawyer.id'>
        <div class="card my-3 p-3 text-center">

          <!-- Image -->
          <div class="rounded-circle overflow-hidden m-auto" style="width:150px; height:150px;">
            <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name" class="img-fluid" >
            <img  v-else src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle m-auto" width="150">
          </div>
          
          <div class="card-body">
            <h5 class="card-title">{{ lawyer.name }} {{lawyer.surname}}</h5>
            <p  v-if="lawyer.services"  class="card-text">{{ truncate(lawyer.services,150) }}</p>
            <router-link :to="{name: 'lawyer-detail', params: { slug: lawyer.slug }}" class="btn btn-primary">
              Dettagli
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <!-- NAVIGATION POSTS -->
    <div class="container d-flex justify-content-center">
      <nav aria-label="page-navigation-example" class="navigation_posts">
        <ul class="pagination my-4">
          <li class="page-item" :class="{'disabled' : currentPage==1}">
            <button class="page-link "  @click="getUsers(currentPage-1)">Previous</button>
          </li>
          <li class="page-item" 
            v-for="i in lastPage" :key="i" 
            :class="{'active': currentPage==i }"
            @click="getUsers(i)"
          >
            <span class="page-link ">{{i}}</span>
          </li>
          
          <li class="page-item" :class="{'disabled': currentPage == lastPage}" >
            <button class="page-link " @click="getUsers(currentPage + 1)">Next</button>
          </li>
        </ul>
      </nav>
    </div>

  </div>
</template>

<script>
// import Search from '../components/Search.vue'
export default {
  name:'LawyersList',
  components:{
    // Search
  },
  data(){
    return{
      url:'http://localhost:8000/api/users',
      lawyers:[],
      currentPage:1,
      lastPage:null,
      urlSpec:'http://localhost:8000/api/specializations',
      expand:false,
      specializationsArray:[],
      selectedSpec: null,
      orderByNum:null,
      orderByVote:null
    }
  },

  created(){
    this.getUsers(1,this.selectedSpec, this.orderByNum, this.orderByVote);
    this. getSpecs();
  },


  methods:{

    // Get all the lawyers from the PI
    getUsers(PageUser,spec,numRev,avgRev){
      axios
      .get(this.url, {params:{
        page:PageUser,
        specialization:spec,
        numberOfReviews:numRev,
        avgVoteReviews:avgRev
      }})
      .then(response=>{
        this.lawyers = response.data.results.data;
        this.currentPage = response.data.results.current_page;
        this.lastPage = response.data.results.last_page;
        // console.log(response.data.results.data);
        // console.log(response.data.results.current_page);
        // console.log(response.data.results.last_page);

      })
    },

    // Get all the lawyers from the PI
    getSpecs(){
      axios
      .get(this.urlSpec)
      .then(response=>{
        this.specializationsArray = response.data.results;          
        // console.log(this.specializationsArray);
      })
    },

    // searchData(val){
    //   axios
    //   .get('http://localhost:8000/api/search/', {params:{
    //     specializations: val
    //   }})
    //   .then(response =>{
    //     this.lawyers = response.data;
    //     console.log(this.lawyers);
    //   })
  
    // },

    // truncate the services paragraph
    truncate(text,maxlength){
      if(text.length > maxlength) {
        return text.substr(0, maxlength) + '...';
      }
      return text;
    },
  },

}
</script>

<style>

</style>