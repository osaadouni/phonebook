
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


// Create your components 
let Myheader = require('./components/Myheader.vue');
let Myfooter = require('./components/Myfooter.vue');
let Home     = require('./components/Home.vue');
let About    = require('./components/About.vue');

// Create some routes 
const routes = [

    { path: '/home', component: Home }, 
    
    { path: '/about', component: About }, 

]

// 3. Create a router instance and pass the 'routes' option 
// You can pass in additional options here, but let's keep
// it simple for now 
const router = new VueRouter({
    
    routes // short for 'routes: routes'
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app', 

    router, 
    
    components: { 'my-header': Myheader, 'my-footer': Myfooter }, 
    
    created() {  
	    console.log('vm instance created!');
    }
});
