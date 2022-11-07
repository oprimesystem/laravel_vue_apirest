require('./bootstrap');

//importar librerias de vue
/*import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router';

Vue.use(VueAxios, axios);
Vue.use(VueRouter);*/
import { createApp } from "vue";

import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router';


const app = createApp({
  // root instance definition
});
app.use(VueAxios, axios);
//app.use(VueRouter, axios);


app.mount("#app");


