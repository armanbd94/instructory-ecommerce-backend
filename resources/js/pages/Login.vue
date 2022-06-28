<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-5 col-md-5">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <h1 class="h4 text-gray-900 mb-4 text-center">Login</h1>
                    <form @submit.prevent="login">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" name="email" id="email" v-model="form.email" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password" id="password" v-model="form.password" class="form-control">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-md w-100">Login</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name:'Login',
    data() {
      return {
        form:{
          email:"",
          password:""
        }
      }
    },
    methods: {
      async login()
      {

        try {
          const res = await axios.post('/login',this.form);
          User.responseAfterLogin(res.data.data);
          Toast.fire({
            icon: 'success',
            title: 'Logged in successfully'
          });
          this.$router.push({name:"dashboard"});
        } catch (error) {
          console.log(error);
        }
        // axios.post('/login',this.form)
        // .then(res => {
        //   User.responseAfterLogin(res.data.data);
        //   Toast.fire({
        //     icon: 'success',
        //     title: 'Logged in successfully'
        //   });
        //   this.$router.push("/");
        // })
        // .catch(err => console.log(err));
      },
    }
}
</script>

<style>

</style>