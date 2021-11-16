<template>
  <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <div v-if="erros.email" class="alert alert-danger">
            {{ erros.email[0] }}
          </div>
          <div v-if="erros.password" class="alert alert-danger">
            {{ erros.email[0] }}
          </div>

          <form id="quickForm" novalidate="novalidate" @submit.prevent="login">
            <div class="input-group mb-2">
              <input
                type="email"
                name="email"
                class="form-control"
                id="exampleInputEmail1"
                placeholder="Enter email"
                v-model="form.email"
              />

              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-2">
              <input
                type="password"
                name="password"
                class="form-control"
                id="exampleInputPassword1"
                placeholder="Password"
                v-model="form.password"
              />

              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success btn-block">
                  Sign In
                </button>
              </div>
            </div>
          </form>

          <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <router-link to="/forgot-password"
              >I forgot my password</router-link
            >
          </p>
          <p class="mb-0">
            <router-link to="/register" class="text-center"
              >Register a new membership</router-link
            >
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
  //First working method after this all method start to work it  is like constructor method of php
  created() {
    //Comes form helpers - checking loggedin or not
    if (User.loggedIn()) {
      //Redirect to dashboard route
      this.$router.push("dashboard");

    }
  },

  //Data property
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
      erros: [],
    };
  },
  //Methods here
  methods: {
    login() {
      axios
        .post("/api/auth/login", this.form)
        .then((response) => {
          //Comes form helpers
          User.responseAfterLogin(response);
          //Redirect to dashboard route
          this.$router.push("dashboard");
          //Toast message
          this.$toast.success({
            title: "Success",
            message: "Sign in successfully",
          });
        })
        // .catch(error =>this.errors = error.response.data.errors)
        .catch((error) => {
          this.erros = error.response.data.errors;
          this.$toast.error({
            title: "Error",
            message: "Email or password is invalid",
          });
        });
    },
    toggleBodyClass(className) {
      const el = document.body;
      console.log(el);
      el.classList.remove(content-wrapper);
    }
  },
};
</script>

<style>
</style>
