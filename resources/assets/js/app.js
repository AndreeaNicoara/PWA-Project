
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import vuetify from './plugins/vuetify';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './routes.js';
import AppComponent from './components/AppComponent'
import store from './store'

import Vuetify from 'vuetify'
// index.js or main.js
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)


store.subscribe(mutation => {
      switch (mutation.type) {
        case "SET_TOKEN":
          if (mutation.payload) {
            axios.defaults.headers.common[
              "Authorization"
            ] = `Bearer ${mutation.payload}`;
            localStorage.setItem("token", mutation.payload);
            
          } else {
            axios.defaults.headers.common["Authorization"] = null;
            localStorage.removeItem("token", mutation.payload);
            router.push({ name: 'login' });
          }
  
          break;
      }
});

console.log('Running');
  
store.dispatch("attempt", localStorage.getItem("token"));

const app = new Vue({
    components: { AppComponent },
    router,
    store,
    // vuetify
}).$mount('#app')
