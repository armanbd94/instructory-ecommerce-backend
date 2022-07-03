<template>
    <component :is="this.$route.meta.layout || 'div'">
      <router-view />
    </component>
</template>

<script>
// import Login from './pages/Login.vue';
export default {
    name: 'App',
    components: {
      // Login
    },
    data(){
        return {

        }
    },

    methods: {
      
      showProfile()
      {
        axios.get('/profile')
        .then(res => {
          console.log(res.data);
        })
        .catch(err => console.log(err.response.data));
      }
    }
}
</script>

<style>
.active-link{
    color: red !important;
}
.exact-active-link{
    color:blue !important;
    font-weight: bold;
}
</style>