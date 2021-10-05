import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from './pages/Home.vue';
import LawyersList from './pages/LawyersList.vue';
import SingleLawyer from './pages/SingleLawyer';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/lawyers',
            name: 'lawyers',
            component: LawyersList,
        },
        {
            path: '/lawyer/:slug',
            name: 'lawyer-detail',
            component: SingleLawyer,
        },
    ],
});

export default router;