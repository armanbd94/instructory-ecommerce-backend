<template>
<div id="wrapper">
    <!-- Sidebar -->
    <Sidebar />
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <Topbar />
        <!-- Topbar -->

        <!-- Container Fluid-->
          
        <div class="container-fluid" id="container-wrapper">
          
            <router-view></router-view>
        </div>

        <!---Container Fluid-->
      </div>

    </div>
  </div>
    
</template>

<script>
import Sidebar from '../components/Sidebar.vue';
import Topbar from '../components/Topbar.vue';
export default {
    name: 'AdminLayout',
    components: {
      Sidebar,Topbar
    },
    data(){
        return {
          isAuthenticate:false,
          token:'',
        }
    },
    created() {
      
    },
    mounted() {
 
    },
    methods: {
      
      showProfile()
      {
        axios.get('/profile')
        .then(res => {
          console.log(res.data);
        })
        .catch(err => console.log(err.response.data));
      },
      logout()
      {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        Toast.fire({
            icon: 'success',
            title: 'Logout successfully'
            })
        this.$router.push({ name: 'login'})
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