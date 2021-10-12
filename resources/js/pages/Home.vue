<template>
  <section>
    <h2>This is the Home</h2>

    <!-- BUTTONS FOR ALL THE SPECIALIZATIONS -->
    <div class="row justify-content-center my-3">
     
      <router-link 
        :to="{name:'lawyers', params:{id: item.id}}" 
        v-for="(item,index) in specializationsArray" :key="index"
        class="btn btn-secondary mx-2" 
      > 
        {{item.name}}
      </router-link>
    
    </div>
  </section>
</template>

<script>
export default {
  name:'Home',
  data(){
    return{
      urlSpec:'http://localhost:8000/api/specializations',
      specializationsArray:[],
      selectedSpec: null,

    }
  },

  
  created(){
    // this.getUsers(1,this.selectedSpec, this.orderByNum, this.orderByVote);
    this.getSpecs();
    

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
  }

}
</script>

<style>

</style>