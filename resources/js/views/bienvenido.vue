<template>
    <div>
        <Header>
            <li class="nav-item" v-if="auth">
                <router-link to="/inicio" class="nav-link">Inicio</router-link>
            </li>
            <li class="nav-item" v-if="!auth">
                <router-link to="/registro" class="nav-link">Registrarse</router-link>
            </li>
            <li class="nav-item" v-if="!auth">
                <router-link to="/login" class="nav-link">Login</router-link>
            </li>
        </Header>
        <div style="height:90vh; display:flex; justify-content:center; align-items:center">
            <div class="container card text-center">
                <h1>Bienvenido</h1>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        if (window.localStorage.getItem('auth')) {
            this.auth = true
        }
    },
    data(){
        return {
            auth:false
        }
    }
}
</script>