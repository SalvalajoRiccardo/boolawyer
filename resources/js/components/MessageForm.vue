<template>

 <div class="container my_container p-5">
    <h2>Send me a message</h2>

    <div v-if="success" class="alert alert-primary">Messaggio inviato</div>

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
        <label for="your_text" class="form-label">Your message</label>
        <textarea  v-model="text" class="form-control" name="text" id="your_text" rows="3" placeholder="Write me a message..."></textarea>
        <p class="alert alert-danger my-2" v-for="(error,index) in errors.text" :key="index">{{error}}</p>
      </div>

      <!-- BUTTON -->
      <button type="submit" class="btn btn-primary">{{sending ? 'invio in corso' : 'Submit'}}</button>
          
    </form>
 </div>
  
</template>

<script>
export default {
    name:'MessageForm',
    props:{
      id:Number
    },

    data(){
      return{
        name:'',
        email:'',
        text:'',
        errors:{},
        sending:false,
        success:false
      }
    },

    methods:{
      sendForm(){
      this.sending=true;
      this.success=false;
      axios.post('/api/messages',{
        'name': this.name,
        'email': this.email,
        'text': this.text,
        'user_id':this.id
      })
      .then(response=>{
        if (!response.data.success) {
          this.errors=response.data.errors;
          this.success=false;
        } else {
          this.success=true;
          // console.log(response);
          this.sending=false;
          this.name="";
          this.email="";
          this.text="";
        }
      })
      .catch(error=>{
        console.log(error);
      })
    }
    }

}
</script>

<style>

</style>