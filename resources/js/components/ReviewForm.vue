<template>
  <div class="container my_container p-5">
    <h2>Write a review</h2>

    <div v-if="success" class="alert alert-primary">Review register</div>

    <form @submit.prevent="sendForm" >

      <!-- NAME -->
      <div class="mb-3">
        <label for="your_reviewer" class="form-label">Reviewer</label>
        <input type="text" v-model="reviewer" class="form-control" name="reviewer" id="your_reviewer" placeholder="What's your name?">
      </div>

      <!-- VOTE -->
      <div class="mb-3">

          <!-- <span class="d-block"><i class="fas fa-star text-warning" v-for="(stella,index) in stelle(dettagli.vote_average)" :key="index"></i></span> -->
          
        <label for="your_vote" class="form-label">Vote </label>
        <input type="number" v-model="vote" class="form-control" name="vote" id="your_vote" placeholder="vote...">
      </div>

      <!-- TEXT -->
      <div class="mb-3">
        <label for="your_text" class="form-label">Your opinion</label>
        <textarea  v-model="text" class="form-control" name="text" id="your_text" rows="3" placeholder="Write me your opinion..."></textarea>
      </div>

      <!-- BUTTON -->
      <button v-on:click="valida" type="submit" class="btn btn-primary">{{sending ? 'invio in corso' : 'Submit'}}</button>
          
    </form>
 </div>
</template>

<script>
export default {
    name:'ReviewForm',
    props:{
      id:Number
    },
    
    data(){
      return{
        reviewer:'',
        vote:'',
        text:'',
        errors:{},
        sending:false,
        success:false
      }
    },

  
    methods:{
      valida(){
        if(this.reviewer == '' || this.reviewer.length < 2){
          alert('Inserisci un nome valido!');
        } else if(this.vote < 1 || this.vote > 5 || this.vote == ''){
          alert('Devi inserire un voto valido! Inserisci un voto tra 1 e 5');
        } else if(this.text == ''){
          alert('Inserisci un messaggio!');
        }
      },
        // stelle(voto){
        //     return parseInt(Math.round(voto / 2))
        // },

        sendForm(){
            this.sending=true;
            this.success=false;
            axios.post('/api/reviews',{
                'reviewer': this.reviewer,
                'vote': this.vote,
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
                this.reviewer="";
                this.vote="";
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