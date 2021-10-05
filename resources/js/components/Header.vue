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
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                         <router-link :to="{name:'home'}" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'lawyers'}" class="nav-link">Lawyers</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  

    <!-- <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>   -->

</template>

<script>
export default {
    name:'Header'

}
</script>

<style>

</style>