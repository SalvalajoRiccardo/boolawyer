<template>

 <div class="container my_container p-5">
    <h2>Send me a message</h2>

    <div v-if="success" class="alert alert-primary">Messaggio inviato</div>

    <form @submit.prevent="sendForm">

      <!-- NAME -->
      <div class="mb-3">
        <label for="your_name" class="form-label">Name</label>
        <input type="text" v-model="name" class="form-control" name="name" id="your_name" placeholder="What's your name?">
      </div>

      <!-- EMAIL ADRESS -->
      <div class="mb-3">
        <label for="your_email" class="form-label">Email address</label>
        <input type="email" v-model="email" class="form-control" name="email" id="your_email" placeholder="Email...">

      </div>

      <!-- MESSAGE -->
      <div class="mb-3">
        <label for="your_text" class="form-label">Your message</label>
        <textarea  v-model="text" class="form-control" name="text" id="your_text" rows="3" placeholder="Write me a message..."></textarea>
      </div>

      <!-- BUTTON -->
      <button v-on:click="valida" type="submit" class="btn btn-primary">{{sending ? 'invio in corso' : 'Submit'}}</button>
          
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
        success:false,
        // name_value: document.getElementById('your_name'),
        // address_value: document.getElementById('your_email'),
        // message_value: document.getElementById('your_text')
      }
    },

    methods:{
      valida(){
        if(this.name == '' || this.name.length < 2){
          alert('Inserisci un nome valido!');
        } else if(!this.email.includes('@') || this.email == ''){
          alert('Devi inserire un indirizzo mail corretto!');
        } else if(this.text == ''){
          alert('Inserisci un messaggio!');
        }
      },
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
    // valida(){
    //   let nome = document.invio.name.value;
    //   let mail = document.invio.email.value;
    //   let message = document.invio.text.value;
    //   if((isNaN(nome)) || (nome == "") || (nome == "undefined")){
    //     alert("Devi inserire il nome!");
    //     document.invio.name.value = "";
    //     document.invio.name.focus();
    //     return false;
    //   }
    //   let email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
    //   if(!email_valid.test(mail) || (mail == "") || (mail == "undefined")){
    //     alert("Devi inserire un indirizzo mail corretto");
    //     document.invio.email.focus();
    //     return false;
    //   }
    //   if((isNaN(message)) || (message == "") || (message == "undefined")){
    //     alert("Devi inserire il messaggio!");
    //     document.invio.text.value = "";
    //     document.invio.text.focus();
    //     return false;
    //   }else{
    //     this.sendForm();
    //   }
    // }

}
</script>

<style>

</style>