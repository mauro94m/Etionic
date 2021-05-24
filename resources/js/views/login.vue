<template>
    <div>
        <form @submit.prevent="getLogin">
            <div style="height: 100vh;display: flex;justify-content: center;align-items: center;">
                <div class="card w-25">
                    <div class="card-header">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="" id="" v-model="form.email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="text" name="" id="" v-model="form.password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Ingresar" class="form-control btn-primary">
                            </div>
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
        async getLogin(){
            await axios
            .post('/api/login', this.form, {headers:{
                withCredentials: true,
            }})
            .then(function(response){
                if (response.data.status) {
                    window.localStorage.setItem('auth', true),
                    window.localStorage.setItem('token', response.data.token),
                    window.localStorage.setItem('user', response.data.user),
                    router.push({name:'inicio'}) 
                }else{
                    alert(response.data.message)
                }
            })
            .catch(response => alert(response.data))
        }
    }
}
</script>