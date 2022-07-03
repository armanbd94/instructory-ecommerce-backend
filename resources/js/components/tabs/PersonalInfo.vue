<template>
  <div class="row">
    <div class="col-md-5 text-left">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" v-model="form.name"  >
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" v-model="form.email">
        </div>
    </div>
  </div>
</template>

<script>
export default {
    name:"PersonalInfo",
    props:["user"],
    data(){
        return {
            form:{
                name:"",
                email:""
            }
        }
    },
    created(){
        // console.log(this.user);
        this.form.name = this.user.name;
        this.form.email = this.user.email;
    }
}
</script>

<style>

</style>