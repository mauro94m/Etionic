<template>
    <div>
        <Header>
            <li>
                <button @click="getLogout" class="btn btn-dark">Logout</button>
            </li>
        </Header>
        <div style="heigth:90vh">
            <div class="container">
                <div class="mb-3">
                    <select name="" id="" v-model="seleccion" @change="getNoticias" class="form-control">
                        <option value="0">Todos</option>
                        <option value="1">Favoritos</option>
                    </select>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Noticia</th>
                            <th v-if="seleccion==1">Link</th>
                            <th>Favorito</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in listado" :id="item[0]">
                            <td>{{item[1]}}</td>
                            <td v-if="seleccion==1">{{item[2]}}</td>
                            <td v-if="seleccion==0"><button class="fa-star" @click="setFavorito(item)">Favorito</button></td>
                            <td v-else><button class="fa-star" @click="deleteFavorito(item[0])">Quitar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import router from '../router.js'
export default {
    mounted(){
        this.getNoticias()
    },
    data(){
        return {
            seleccion:0,
            listado:[]
        }
    },
    methods:{
        async getLogout(){
            await axios.get('/sanctum/csrf-cookie', {withCredentials:true})
            await axios
            .post('/api/logout', {headers: {
                Authorization: 'Bearer '+window.localStorage.getItem('token')
            }})
            .then(function(response){
                localStorage.removeItem('auth'),
                localStorage.removeItem('token'),
                localStorage.removeItem('user'),
                router.push({name:'bienvenido'}) 
            })
        },
        async setFavorito(favorito){
            await axios.get('/sanctum/csrf-cookie', {withCredentials:true})
            await axios
                    .post('/api/favorito', { 'favorito':favorito },
                        {headers:{
                            withCredentials: true,
                            Authorization : 'Bearer '+window.localStorage.getItem('token')
                        }})
                    .then(function(response){
                        alert('Agregado a favoritos')
                    })
        },
        async getNoticias(){
            let vm = this
            if (this.seleccion == 0) {
                await axios
                .get('https://hacker-news.firebaseio.com/v0/newstories.json', {headers:{
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }})
                .then(function(response){
                    vm.listado = []
                    let ultimas = response.data.slice(0,10)
                    ultimas.forEach(item => {
                        axios
                        .get('https://hacker-news.firebaseio.com/v0/item/'+item+'.json?print=pretty')
                        .then(function(response){
                            vm.listado.push([item, response.data.title])
                        })
                    })
                })   
            }else{
                await axios
                    .get('/api/favorito',
                        {headers:{
                            withCredentials: true,
                            Authorization : 'Bearer '+window.localStorage.getItem('token')
                        }}
                    )
                    .then(function(response){
                        console.log(response)
                        vm.listado = []
                        response.data.forEach(item => {
                            vm.listado.push([item.id, item.titulo, item.link])
                        })
                    })
            }
        },
        async deleteFavorito(favorito){
            await axios.get('/sanctum/csrf-cookie', {withCredentials:true})
            await axios
            .delete('/api/favorito/'+favorito, {
                withCredentials: true,
                Authorization: 'Bearer' + localStorage.getItem('token')
            })
            .then(this.getNoticias())
        }
    }
}
</script>