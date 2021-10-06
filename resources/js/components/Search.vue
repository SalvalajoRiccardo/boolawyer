<template>
    <div class="bg-secondary text-center">

        <!-- ADVANCED-SEARCH container -->
        <div class="row" v-if="expand">

            
            <!-- TYPES: buttons for selecting the SPECIALIZATIONS -->
            <!-- <form> -->

                <div class="types">
                    <button :class="item" v-for="(item,index) in specializationsArray" :key="'a'+ index" @change.prevent="sendForm">
                        <input type="radio" :id="'a' + index" :value="item.name" v-model="selectedSpec" name="specializations">
                        <label :for="'a' + index">{{item.name}}</label>
                    </button>
                </div>


                <!-- <div class="col-12 col-md-6">
                    <select class="form-select" aria-label="Default select example" v-model="selectedSpec">
                        <option disabled selected value="">Choose a specialization</option>
                        <option v-for="(item,index) in specializationsArray" :key="index" :value="item.name">{{item.name}}</option>
                    </select>
                </div> -->
            <!-- </form> -->

            <!-- ALL FILTERS: 3 Buttons for different heights + 3 Buttons for different weights -->
            <div class="col-12 col-md-6">

                <!-- Buttons for different heights -->
                <!-- <div class="height">
                    <h2>Altezza</h2>
                    <div class="all-buttons-height" @change="$emit('sendHeight', pickedHeight)">
                        <button class="height-item" >
                            <input type="radio" id="one" value="10" v-model="pickedHeight" >
                            <label for="one"><img src="../assets/img/002_Ivysaur_icon-icons.com_67333.png" alt="ivysaur"></label>
                        </button>
                        <button class="height-item">
                            <input type="radio" id="two" value="20" v-model="pickedHeight" >
                            <label for="two"><img src="../assets/img/Milotic_icon-icons.com_67385.png" alt="milotic"></label>
                        </button>
                        <button class="height-item">
                            <input type="radio" id="three" value="50" v-model="pickedHeight" >
                            <label for="three"><img src="../assets/img/Rayquaza_icon-icons.com_67460.png" alt="rayquaza"></label>
                        </button>
                    </div> -->
                <!-- </div> -->

                <!-- 3 Buttons for different weights -->
                <!-- <div class="weight">
                    <h2>Peso</h2>
                    <div class="all-buttons-weight" @change="$emit('sendWeight', pickedWeight)">
                        <button class="weight-item">
                            <input type="radio" id="four" value="100" v-model="pickedWeight">
                            <label for="four"><img src="../assets/img/036_Pichu_icon-icons.com_67298.png" alt="pichu"></label>
                        </button>
                        <button class="weight-item">
                            <input type="radio" id="five" value="500" v-model="pickedWeight">
                            <label for="five"><img src="../assets/img/009_Blastoise_icon-icons.com_67326.png" alt="blaistoise"></label>
                        </button>
                        <button class="weight-item">
                            <input type="radio" id="six" value="1000" v-model="pickedWeight">
                            <label for="six"><img src="../assets/img/Snorlax_icon-icons.com_67365.png" alt="snorlax"></label>
                        </button>
                    </div>
                </div> -->

            </div>
         
        </div> 

        <!-- ADVANCED-SEARCH buttons: EXPAND/CLOSE -->
        <div class="expand py-3">
            <div class="btn-container">
                <button class="btn btn-light" @click="expand=true" v-if="!expand">Ricerca avanzata</button>
                <button class="btn btn-light" @click="expand=false" v-else>Close</button>
            </div>    
        </div>

    </div>
</template>

<script>
export default {
    name:'Search',
    props:{
        
    },

    
    data() {
        return {
            url:'http://localhost:8000/api/specializations',
            expand:false,
            specializationsArray:[],
            selectedSpec:''
        }
    },

    created(){
        this.getSpecs();
    },
    methods: {

        // Get all the lawyers from the PI
        getSpecs(){
        axios
        .get(this.url)
        .then(response=>{
            this.specializationsArray = response.data.results;          
            console.log(this.specializationsArray);
        })
        },

        sendForm(){
      
            axios.post('/api/users',{
                'specialization': this.selectedSpec,
            })
            .then(response=>{
                if (!response.data.success) {
                this.errors=response.data.errors;
                
                } else {
                // console.log(response.config.data);
                //   this.selectedSpec="";
            
                }
            })
            .catch(error=>{
                console.log(error);
            })
        }
        
    }
}
</script>