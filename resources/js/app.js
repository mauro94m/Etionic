require('./bootstrap');
import Vue from 'vue'
import router from './router.js'

Vue.component('Header', require('./component/Header.vue').default);

new Vue({
    el:'#app',
    router,
})