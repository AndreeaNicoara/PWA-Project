<template>

    <router-view></router-view>
               
</template>

<script>
    export default {
         data() {
            return {
              
            };
        },

        created() {

            // if(localStorage.token) {
            //      axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem('token')}`;

            //     axios.get('/api/user').then(response => {
            //         store.commit('loginUser')
            //         this.isLoggedIn = true;
            //     }).catch(error => {
            //         if (error.response.status === 401 || error.response.status === 403) {
            //             this.isLoggedIn = false;
            //             axios.defaults.headers.common["Authorization"] = null;
            //             store.commit('logoutUser')
            //             localStorage.setItem('token', '')
            //             this.$router.push({name: 'login'})
            //         }

            //     });
            // }

        }
    }
</script>


<style>

.v-dialog__content{
    z-index: 10000 !important;
}

.grey.lighten-2{
    background-color: #fb0 !important;
    display: block !important;
}

.float-position-right{
    float: right !important;
}

.margin-top-minus-10{
    margin-top: -10px !important;
}

</style>
