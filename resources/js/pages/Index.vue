<template>
    <div id="wrapper">
        <!-- Sidebar -->
        <sidebar />
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <Topbar @logout="logout" />
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
import Sidebar from '../Components/Sidebar.vue';
import Topbar from '../Components/Topbar.vue';
export default {
    name: "Index",
    components: {
      Sidebar,Topbar
    },
    methods: {
      logout()
      {
        User.logout();
        Toast.fire({
            icon:'success',
            title:'Logout Successfully'
          });
          this.$router.push({name:'login'});
      }
    }
};

</script>

<style>
</style>
