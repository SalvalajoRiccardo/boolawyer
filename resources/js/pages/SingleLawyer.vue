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

      <!-- start messaggio -->
      <form @submit.prevent="sendForm" >

        <!-- NAME -->
        <div class="mb-3">
          <label for="your_name" class="form-label">Name</label>
          <input type="text" v-model="name" class="form-control" name="name" id="your_name" placeholder="What's your name?">
          <p class="alert alert-danger my-2" v-for="(error,index) in errors.name" :key="index">{{error}}</p>
        </div>

        <!-- EMAIL ADRESS -->
        <div class="mb-3">
          <label for="your_email" class="form-label">Email address</label>
          <input type="email" v-model="email" class="form-control" name="email" id="your_email" placeholder="Email...">
          <p class="alert alert-danger my-2" v-for="(error,index) in errors.email" :key="index">{{error}}</p>
        </div>

        <!-- MESSAGE -->
        <div class="mb-3">
          <label for="your_text" class="form-label">Example textarea</label>
          <textarea  v-model="text" class="form-control" name="text" id="your_text" rows="3" placeholder="Write me a message..."></textarea>
          <p class="alert alert-danger my-2" v-for="(error,index) in errors.text" :key="index">{{error}}</p>
        </div>

        <!-- BUTTON -->
        <button type="submit" class="btn">{{sending ? 'invio in corso' : 'Submit'}}</button>
        
    </form>
    <!-- end messaggio -->

    </div>
</template>

<script>

export default {
    name: "SingleLawyer",
    components: {
      
    },
    data() {
      return {
        lawyer: [],
        name:'',
        email:'',
        text:'',
        errors:{},
        sending:false,
        success:false
      }
    },
    mounted(){
      // console.log(this.$route.params.slug);
      axios.get('/api/user/'+ this.$route.params.slug)
        .then( response => {
          this.lawyer = response.data.results;
          console.log(this.lawyer);
        } )
        .catch(error => {
          console.log(error);
        });

    },
    methods:{
    sendForm(){
      this.sending=true;
      this.success=false;
      axios.post('/api/messages',{
        'name': this.name,
        'email': this.email,
        'text': this.text,
        'user_id':this.lawyer.id
      })
      .then(response=>{
        if (!response.data.success) {
          this.errors=response.data.errors;
          this.success=false;
        } else {
          this.success=true;
          console.log(response);
          this.sending=false;
          this.name="";
          this.email="";
          this.message="";
        }
      })
      .catch(error=>{
        console.log(error);
      })
    }
  }

};
</script>

<style>

</style>