<template>
  <div class="row">
    <div class="col-md-5">
        <form @submit.prevent="changePassword">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" v-model="form.current_password" id="current_password" class="form-control">
                <small v-if="errors.current_password" class="text-danger">{{errors.current_password[0]}}</small>
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" v-model="form.password" id="password" class="form-control">
                <small v-if="errors.password" class="text-danger">{{errors.password[0]}}</small>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="form-control">
                <small v-if="errors.password_confirmation" class="text-danger">{{errors.password_confirmation[0]}}</small>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Change Password</button>
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
                password_confirmation:""
            },
            errors:{}
        }
    },
    methods:{
        changePassword()
        {
            axios.post('change-password',this.form)
            .then(res =>{
                if(res.data.status === true)
                {
                    Toast.fire({
                        icon:'success',
                        title:'Password Changed Successfully'
                    });
                    this.form={
                        current_password:"",
                        password:"",
                        password_confirmation:""
                    };
                    this.errors={};
                }else{
                    Toast.fire({
                        icon:'error',
                        title: res.data.message
                    });
                }
            }).catch(error=>{
                this.errors = error.response.data.errors;
            });
        }
    }
   
}
</script>

<style>

</style>