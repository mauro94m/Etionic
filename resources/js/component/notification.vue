<template>
    <div>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell" id="notify-icon"></i>    
                <span v-show="unreadNotifications.length > 0">{{unreadNotifications.length}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="" v-for="(unread, index) in unreadNotifications">
                    <h5>{{unread.data.titulo}}</h5>
                </a>
            </div>
        </li>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    mounted(){
        this.getNotifications()
    },
    data(){
        return {
            unreadNotifications: {}
        }
    },
    methods: {
        getNotifications(){
            axios
            .get('/api/unreadnotifications',
                {headers:{
                    withCredentials: true,
                    Authorization : 'Bearer '+window.localStorage.getItem('token')
                }}
            )
            .then(response => this.unreadNotifications = response.data)
            .catch((errors) => {console.log(errors)})
        }
    }
}
</script>