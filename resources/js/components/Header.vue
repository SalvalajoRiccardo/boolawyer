<template>

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <!-- LOGO -->
            <div class="logo_box">
                <router-link class="navbar-brand" :to="{name:'home'}">
                    LOGO
                </router-link>
            </div>

            <!-- TOGGLE -->
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <!-- NAVBAR -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                         <router-link :to="{name:'home'}" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'lawyers'}" class="nav-link">Lawyers</router-link>
                    </li>
                   
                </ul>

                <ul  class="navbar-nav">
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

<style>

</style>