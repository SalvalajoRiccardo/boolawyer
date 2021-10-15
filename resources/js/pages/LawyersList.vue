<template>
  <div class="container">

    <!-- BUTTONS FOR ALL THE SPECIALIZATIONS -->
    <div class="row justify-content-center my-3">
      <button class="btn btn-blue btn-outline-light border-0 mx-2 mt-4" v-for="(item,index) in specializationsArray" :key="'a'+ index" @change="getUsers(1, selectedSpec)" :class="(item.id == selectedSpec)?'selectedButton':''">
          <input type="radio" class="d-none" :id="'a' + index" :value="item.id" v-model="selectedSpec" name="specializations">
          <label :for="'a' + index">{{item.name}}</label>
      </button>
       <!-- <button class="btn btn-secondary mx-2" v-for="(item,index) in specializationsArray" :key="index">
        <router-link :to="{name:'lawyers', params:{id: item.id}}"> {{item.name}}</router-link>
      </button> -->
    </div>

    <!-- FILTER BOTTON PER NUMBER AVERAGE_VOTE OF REVIEWS -->
    <div class="row justify-content-center my-3">
      <!-- BUTTON ORDER BY NUMBER -->
      <button class="btn btn-bronze mx-2 my-3" @click="getUsers(1, selectedSpec,orderByNum==true,orderByVote)">
        ordina per numero di reviews
      </button>

    <!-- BUTTON ORDER BY VOTE -->
      <button class="btn btn-bronze mx-2 my-3" @click="getUsers(1, selectedSpec,orderByNum, orderByVote==true)">
        ordina per media voti delle reviews
      </button>
    </div>
   
    <!-- LAWYERS -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col" v-for="lawyer in lawyers" :key='lawyer.id'>
        <div class="card my-3 p-3 text-center">

          <!-- Image -->
          <div class="rounded-circle overflow-hidden m-auto bg-white" style="width:150px; height:150px;">
            <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name" class="img-fluid" :title="lawyer.name">
            <img  v-else :src="'/images/user.png'" alt="Admin" class="rounded-circle m-auto" width="150">
          </div>

          <div class="card-body">

            <div class="my-3">

              <!-- REVIEW NUMBER -->
              <div v-if="lawyer.reviews" class="badge rounded-pill text-white position-relative mx-1">
                <span>{{getNumberOfReview(lawyer.reviews)}}</span> Reviews
              </div>

              <div v-if="lawyer.reviews.length >= 1" class="badge rounded-pill text-white position-relative mx-1">
                Voto medio: <span>{{getVoteReview(lawyer.reviews).toFixed(1)}}</span>
              </div>

            </div>
            
            <h5 class="card-title">{{ lawyer.name }} {{lawyer.surname}}</h5>
            <p  v-if="lawyer.services"  class="card-text">{{ truncate(lawyer.services,150)}}</p>
            <router-link :to="{name: 'lawyer-detail', params: { slug: lawyer.slug }}" class="btn btn-blue">
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
            <button class="page-link "  @click="getUsers(currentPage-1)">Precedente</button>
          </li>
          <li class="page-item" 
            v-for="i in lastPage" :key="i" 
            :class="{'active': currentPage==i }"
            @click="getUsers(i)"
          >
            <span class="page-link ">{{i}}</span>
          </li>
          
          <li class="page-item" :class="{'disabled': currentPage == lastPage}" >
            <button class="page-link " @click="getUsers(currentPage + 1)">Successiva</button>
          </li>
        </ul>
      </nav>
    </div>

  </div>
</template>

<script>
export default {
  name:'LawyersList',
  props:{
    id:Number
  },
  components:{
    
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
      selectedSpec: this.id,
      orderByNum:null,
      orderByVote:null,
    }
  },

  created(){
    this.getUsers(1,this.selectedSpec, this.orderByNum, this.orderByVote);
    this.getSpecs();
    

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
        console.log(response.data.results.data);
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

    // Get the number of all reviews
    getNumberOfReview(array){
      let counter = 0;
      for (let i = 0; i < array.length; i++) {
        counter++;
      }

      return counter;
    },

    getVoteReview(array){
      let sum = 0;
      array.forEach(element => {
        sum += element.vote
      });
      var avg = sum/array.length;

      return avg ;
    },

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

<style lang="scss" scoped>
  // Colors
  $lawblue: #2c4065;
  $lawbronze: #b69d73;
  $lawred: #83354c;
  $notwhite: #ddd;

  .selectedButton{
    background-color:#ddd;
    color: #b69d73;
  }


  .card{
    background-color: rgba(119, 119, 119, 0.9);
    color: #ddd;
    height:483px;

    & h5 {
      color: $lawblue;
      font-size: 1.5rem;
      font-weight: 800;
      letter-spacing: 2px;
    }

    & .rounded-pill {
      background-color: $lawbronze;
      padding: 8px;
      font-size: 1.1rem;

      & span {
        color: $lawblue;
        
      }
    }

    & .modal h5 {
      color: $lawblue;
    }
  }

</style>