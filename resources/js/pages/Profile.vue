<template>

    <div class="row">
      <div class="col-lg-12 col-sm-12 col-12 main-section text-center">
        <div class="row">
          <div class="col-lg-12 col-sm-12 col-12 profile-header"></div>
        </div>
        <div class="row user-detail">
          <div class="col-lg-12 col-sm-12 col-12">
            <img src="assets/img/boy.png" class="rounded-circle img-thumbnail" />
            <div class="col-md-12 text-left">
                <button class="btn btn-sm mr-3" @click="activeTab='PersonalInfo'" :class="activeTab == 'PersonalInfo' ? 'btn-primary' : ' btn-secondary'">Personal Information</button>
                <button class="btn btn-sm" @click="activeTab='ChangePassword'" :class="activeTab == 'ChangePassword' ? 'btn-primary' : ' btn-secondary'">Change Password</button>
            </div>
            <div class="col-md-12 pt-5">
                <keep-alive><component :is="activeTab" :user="user" /></keep-alive>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  
</template>

<script>
import PersonalInfo from '../components/tabs/PersonalInfo.vue';
import ChangePassword from '../components/tabs/ChangePassword.vue';
export default {
  name: "Profile",
  components: {
    PersonalInfo,ChangePassword
  },
  data(){
    return {
        activeTab:'PersonalInfo',
        user:{}
    }
  },
  created(){
    this.user = User.userInfo();
    }
};
</script>

<style scoped>
.main-section {
  /* border: 1px solid #4c60da; */
  background-color: #fff;
  box-shadow: 0px 1px 1px rgba(0,0,0,0.5);
  height: 100vh;
}
.profile-header {
  background-color: #4c60da;
  height: 150px;
}
.user-detail {
  margin: -50px 0px 30px 0px;
}
.user-detail img {
  height: 100px;
  width: 100px;
}
.user-detail h5 {
  margin: 15px 0px 5px 0px;
}
.user-social-detail {
  padding: 15px 0px;
  background-color: #4c60da;
}
.user-social-detail a i {
  color: #fff;
  font-size: 23px;
  padding: 0px 5px;
}
</style>