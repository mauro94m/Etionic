import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import bienvenido from './views/bienvenido.vue'
import registro from './views/registro.vue'
import login from './views/login.vue'
import inicio from './views/inicio.vue'

const router = new VueRouter({
    routes: [
        {
            path:"/",
            name:'bienvenido',
            component:bienvenido
        },
        {
            path:"/registro",
            name:'registro',
            component:registro
        },
        {   
            path:'/login',
            name:'login',
            component:login
        },
        {
            path:'/inicio',
            name:'inicio',
            component:inicio,
        },
    ],
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    if (to.name == 'inicio') {
        if(!window.localStorage.getItem('token')){
            router.push({name:'login'})
        }
    }
    
    return next();
});

export default router