<template>
  <div class="container my_container p-5">
    <h2 class="text_bronze">Scrivi una recensione</h2>

    <div v-if="success" class="alert alert-primary">La tua Review è stata registrata</div>

    <form @submit.prevent="sendForm" >

      <div class="row">
        <!-- NAME -->
      <div class="mb-3 col-12 col-md-6">
        <label for="your_reviewer" class="form-label">Reviewer</label>
        <input type="text" v-model="reviewer" class="form-control" name="reviewer" id="your_reviewer" placeholder="Il tuo nome">
      </div>

      <!-- VOTE -->
      <div class="mb-3 col-12 col-md-6">

          <!-- <span class="d-block"><i class="fas fa-star text-warning" v-for="(stella,index) in stelle(dettagli.vote_average)" :key="index"></i></span> -->
          
        <label for="your_vote" class="form-label">Voto</label>
        <input type="number" v-model="vote" min="1" max="5" class="form-control" name="vote" id="your_vote" placeholder="Il tuo voto">
      </div>
      </div>

      <!-- TEXT -->
      <div class="mb-3">
        <label for="your_text" class="form-label">La tua opinione</label>
        <textarea  v-model="text" class="form-control" name="text" id="your_text" rows="3" placeholder="Lascia un commento..."></textarea>
      </div>

      <!-- BUTTON -->
      <button v-on:click="valida" type="submit" class="btn btn-blue">{{sending ? 'invio in corso' : 'Invio'}}</button>
          
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

<style lang="scss" scoped>

.text_bronze{
  color:#b69d73
}

$lawblue: #2c4065;
  form {

    & #your_reviewer::placeholder,
    & #your_vote::placeholder,
    & #your_text::placeholder{
      color: $lawblue;
      font-weight: 600;
      opacity: .8;
    }

    & #your_reviewer,
    & #your_vote,
    & #your_text {
      color: $lawblue;
    }

    & .btn-blue{
      font-size: 1rem;
    }
  }

  .my_container {
    background-color: rgba(119, 119, 119, 0.9);
    color: #ddd;
    border-radius: 5px;
    border: 1px solid #6d6d6d;
  }
</style>