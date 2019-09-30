/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
Vue.use(BootstrapVue);

/*
 *   ROUTES for Components
 */
import VueRouter from "vue-router";

Vue.use(VueRouter);
let routes = [
    {
        path: "/example",
        component: require("./components/ExampleComponent.vue").default
    },
    {
        path: "/task",
        component: require("./components/Task.vue").default
    },
    {
        path: "/test_case",
        component: require("./components/TestCase.vue").default
    },
    {
        path: "/create_a_will",
        component: require("./components/CreateAWill/Index.vue").default
    }
];
const router = new VueRouter({
    mode: "history",
    routes // short hand for 'routes: routes'
});

//This is the Form class to be used inside the different components
window.Fire = new Vue();

//Sweet Alerts
import VueSweetalert2 from "vue-sweetalert2";

Vue.use(VueSweetalert2);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component(
//     "/example-component",
//     require("./components/ExampleComponent.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router
});
