<template>
  <div>
    <div class="register-page" style="min-height: 570.391px">
      <div class="register-box">
        <div class="register-logo">
          <a href=""><b>Admin</b>LTE</a>
        </div>

        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form id="form" @submit.prevent="login">
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Full name"
                  v-model="form.name"
                />
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" v-model="form.email"/>

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Password"
                  v-model="form.password"
                />
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Retype password"
                  v-model="form.confirm_password"
                />
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- /.col -->
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">
                    Register
                  </button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i>
                Sign up using Facebook
              </a>
              <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i>
                Sign up using Google+
              </a>
            </div>

            <router-link to="/" class="text-center">I already have a membership</router-link>
          </div>
          <!-- /.form-box -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.register-box -->
    </div>
  </div>
</template>
<script type="text/javascript">
export default {
  //First working method
  created() {
    //Comes form helpers
    if (User.loggedIn()) {
      //Redirect to dashboard route
      this.$router.push('dashboard');
    }
  },
  //Data property
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        confirm_password: null
      },
      erros: [],
    };
  },
  //Methods here
  methods: {
    login() {
      axios
        .post('/api/auth/signup', this.form)
        .then((response) => {
          User.responseAfterLogin(response);
          //Toast message
          this.$toast.success({
            title: "Success",
            message: "Registration successfull",
          });
          this.$router.push('/');
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
          this.$toast.error({
            title: "Error",
            message: "Registration not successfull",
          });
        });
    },
  },
};
</script>


