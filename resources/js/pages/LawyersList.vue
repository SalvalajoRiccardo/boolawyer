<template>
  <div class="container">
    <Search/>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col" v-for="lawyer in lawyers" :key='lawyer.id'>
        <div class="card my-3 p-3 text-center">

          <!-- Image -->
          <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name" class="card-img-top" >
          <img  v-else src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle m-auto" width="150">
          
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
import Search from '../components/Search.vue'
export default {
  name:'LawyersList',
  components:{
    Search
  },
  data(){
    return{
      url:'http://localhost:8000/api/users',
      lawyers:[],
      currentPage:1,
      lastPage:null
    }
  },

  created(){
    this.getUsers(1);
  },

  methods:{

    // Get all the lawyers from the PI
    getUsers(PageUser){
      axios
      .get(this.url, {params:{
        page:PageUser
      }})
      .then(response=>{
        this.lawyers = response.data.results.data;
        this.currentPage = response.data.results.current_page;
        this.lastPage = response.data.results.last_page;
        console.log(this.lawyers);
        console.log(response.data.results.current_page);
        console.log(response.data.results.last_page);

      })
    },

    // truncate the services paragraph
    truncate(text,maxlength){
      if(text.length > maxlength) {
        return text.substr(0, maxlength) + '...';
      }
      return text;
    },
  }
}
</script>

<style>

</style>