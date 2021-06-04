require('./bootstrap');
import Vue from 'vue'
import router from './router.js'

Vue.component('Header', require('./component/Header.vue').default);
Vue.component('NotificationComponent', require('./component/notification.vue').default);

new Vue({
    el:'#app',
    router,
})