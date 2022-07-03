<template>
  <div class="row">
    <div class="col-md-5 text-left">
        <form @submit.prevent="changePassword">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" id="current_password" v-model="form.current_password"  >
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" v-model="form.password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" v-model="form.confirm_password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sam">Change Password</button>
            </div>
        </form>
    </div>
  </div>
</template>

<script>
export default {
    name:"ChangePassword",
    props:["user"],
    data(){
        return {
            form:{
                current_password:"",
                password:"",
                confirm_password:""
            }
        }
    },
    methods:{
        changePassword(){

        }

    }
    
}
</script>

<style>

</style>