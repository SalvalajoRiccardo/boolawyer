<template>
<!-- navbar-dark bg-dark -->

 <nav class="navbar navbar-expand-lg ">
        <div class="container">

            <!-- LOGO -->
            <div class="logo_box">
                <router-link class="navbar-brand" :to="{name:'home'}">
                    <img src="../../../public/storage/photo/logo.png" alt="logo Boolawyer"
                    title="Clicca qui per tornare alla home">    
                </router-link>
            </div>

            <!-- TOGGLE -->
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <!-- NAVBAR -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav header-nav">
                    <li class="nav-item">
                         <router-link :to="{name:'home'}" class="nav-link"><span>Boolawyer</span></router-link>
                    </li>
                    <!-- <li class="nav-item">
                        <router-link :to="{name:'lawyers'}" class="nav-link">Lawyers</router-link>
                    </li> -->
                   
                </ul>

                <ul  class="navbar-nav header-nav">
                     <li class="nav-item ">
                        <a href="http://127.0.0.1:8000/login" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item ">
                        <a href="http://127.0.0.1:8000/register" class="nav-link">Register</a>  
                    </li>
                </ul>

            </div>
        </div>
    </nav>
  

    

</template>

<script>
export default {
    name:'Header'

}
</script>

<style lang="scss">
  $lawblue: #2c4065;
  $lawbronze: #b69d73;
  $lawred: #83354c;
  $notwhite: #ddd;

   nav.navbar {
       background-color: $lawred;
   }

   .logo_box {
    color: $notwhite;
    text-shadow: 0 3px $lawblue;
    animation: slideInLeft 1s ease-out;

    & img{
      max-height: 4rem;
    }
  }

   .header-nav li>a,
   .header-nav li>a:link,
   .header-nav li>a:active {
       text-decoration: none;
       font-size: 1.2rem;
       color: $lawbronze;
       animation: slideInRight 1s ease-out;
       transition: .5s;
       &:hover {
           transform: scale(1.1);
           color: $lawbronze;
       }
       & span {
           font-size: 2rem;
           font-weight: 300;
       }
   }
</style>