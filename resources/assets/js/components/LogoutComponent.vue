<template>

</template>

<script>
    import store from '../store'
    export default {
        mounted () {
             store.dispatch('logout')
            // localStorage.removeItem('token')
            // store.commit('logoutUser')
            // this.$router.push({ name: 'login' })
        }
    }
</script>
