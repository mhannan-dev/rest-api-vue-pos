<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Update customer</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form
                  @submit.prevent="updateCustomer"
                >
                  <input type="hidden" name="_method" value="PATCH" />
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter name"
                        v-model="form.name"
                        name="name"
                      />
                      <p v-if="erros.name" class="text-danger">
                        {{ erros.name[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        placeholder="Enter Email"
                        v-model="form.email"
                        name="email"
                      />
                      <p v-if="erros.email" class="text-danger">
                        {{ erros.email[0] }}
                      </p>
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="mobile">Mobile No</label>
                      <input
                        type="text"
                        class="form-control"
                        name="mobile"
                        placeholder="Enter mobile No"
                        v-model="form.mobile"
                      />
                      <p v-if="erros.mobile" class="text-danger">
                        {{ erros.mobile[0] }}
                      </p>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="address">Address</label>
                      <input
                        class="form-control"
                        name="address"
                        v-model="form.address"
                        placeholder="Enter address"
                      />
                      <p v-if="erros.address" class="text-danger">
                        {{ erros.address[0] }}
                      </p>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success">Update</button>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12"></div>
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
  created() {
    //Comes form helpers - checking loggedin or not
    if (!User.loggedIn()) {
      this.$router.push("/");
    }
  },
  //Data property
  data() {
    return {
      form: {
        name: null,
        email: null,
        mobile: null,
        address: null
      },
      erros: [],
    };
  },
  //Methods here
  methods: {
    addCustomer() {
      axios
        .post("/api/customer", this.form)
        .then((response) => {
          //Toast message
          Notifications.success();
          this.$router.push("customers");
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
  },
};
</script>

<style scoped>
</style>
