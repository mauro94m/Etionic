<template>
    <div>
        <form @submit.prevent="getRegistro">
            <div style="height: 100vh;display: flex;justify-content: center;align-items: center;">
                <div class="card w-25">
                    <div class="card-header">
                        <h3>Registrarse</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="">Nombre</label><br>
                            <input type="text" name="" id="" v-model="form.name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label><br>
                            <input type="text" name="" id="" v-model="form.email" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label><br>
                            <input type="text" name="" id="" v-model="form.password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Confirmar Password</label><br>
                            <input type="text" name="" id="" v-model="form.password_confirmation" class="form-control">
                        </div>
                        <div>
                            <input type="submit" value="Terminar" class="form-control btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import axios from 'axios'
import router from '../router.js'
export default {
    data(){
        return {
            form:{
                name:'',
                email:'',
                password:'',
                password_confirmation:''
            }
        }
    },
    methods:{
        async getRegistro(){
            await axios
            .post('/api/registro', this.form, {headers:{
                withCredentials: true,
            }})
            .then(function(response){
                window.localStorage.setItem('auth', true),
                window.localStorage.setItem('token', response.data.token),
                window.localStorage.setItem('user', response.data.user),
                router.push({name:'inicio'}) 
            })
            .catch(error => alert(error.message))
        }
    }
}
</script>