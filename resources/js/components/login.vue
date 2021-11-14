<template>
  <div>
    <section class="content mt-2">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Login</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form
                id="quickForm"
                novalidate="novalidate"
                @submit.prevent="login"
              >
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input
                      type="email"
                      name="email"
                      class="form-control"
                      id="exampleInputEmail1"
                      placeholder="Enter email"
                      v-model="form.email"
                    />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input
                      type="password"
                      name="password"
                      class="form-control"
                      id="exampleInputPassword1"
                      placeholder="Password"
                      v-model="form.password"
                    />
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>

                  <router-link to="/register" class="btn btn-success">
                    Register
                  </router-link>

                  <router-link to="/forget-password" class="btn btn-warning">
                    Forget Password
                  </router-link>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
</template>

<script type="text/javascript">
export default {
  data(){
    return {
      form: {
          email: null,
          password: null
      }
    }
  },
  methods:{
    login(){
        axios.post("/api/auth/login",this.form)
        .then((response) => {
          console.log(response.data)
        })
        .catch((error) => {
          console.log(error);
        });
    },
  }
  }
</script>

<style>
</style>
