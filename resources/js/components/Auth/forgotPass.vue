<template>

<div class="login-page" style="min-height: 332.391px;">
    <div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Forgot</b>Password</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="recover-password.html" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <router-link to="/">Login</router-link>
      </p>
      <p class="mb-0">
        <router-link to="/register" class="text-center">Register a new membership</router-link>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</div>
</template>

<script>
export default {

}
</script>

<style>

</style>
