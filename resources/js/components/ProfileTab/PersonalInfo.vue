<template>
  <div class="row">
    <div class="col-md-5">
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="form.name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="form.email" id="email" class="form-control">
            </div>
        </form>
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
        this.form.name = this.user.name;
        this.form.email = this.user.email;
    }
}
</script>

<style>

</style>