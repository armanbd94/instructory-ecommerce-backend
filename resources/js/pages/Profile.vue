<template>
    <div class="row">
        <div class="col-lg-12 main-section text-center">
            <div class="row">
                <div class="col-lg-12 profile-header"></div>
            </div>
            <div class="row user-detail">
                <div class="col-lg-12">
                    <img src="assets/img/boy.png" class="rounded-circle imh-thumbnail" :alt="user.name">
                    <div class="col-lg-12 text-left">
                        <button class="btn btn-sm mr-3" @click="activeTab='PersonalInfo'" :class="activeTab=='PersonalInfo' ? 'btn-primary' : 'btn-secondary'">Personal Information</button>
                        <button class="btn btn-sm mr-3" @click="activeTab='ChangePassword'" :class="activeTab=='ChangePassword' ? 'btn-primary' : 'btn-secondary'">Change Password</button>
                    </div>
                    <div class="col-lg-12 text-left pt-3">
                        <keep-alive><component :is="activeTab" :user="user" /></keep-alive>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PersonalInfo from '../Components/ProfileTab/PersonalInfo.vue';
import ChangePassword from '../Components/ProfileTab/ChangePassword.vue';
export default {
    name:"Profile",
    components:{
        PersonalInfo,ChangePassword
    },
    data(){
        return {
            user:{},
            activeTab:'PersonalInfo'
        }
    },
    created() {
        this.user = User.userInfo();
    }
}
</script>

<style scoped>
.main-section{
    background-color:#fff;
    box-shadow: 0px 1px 1px rgba(0,0,0,0.5);
}
.profile-header{
    background-color: #4c60da;
    height:150px;
}
.user-detail{
    margin: -50px 0px 30px 0px;
}
.user-detail img{
    height:100px;
    width:100px;
}
</style>