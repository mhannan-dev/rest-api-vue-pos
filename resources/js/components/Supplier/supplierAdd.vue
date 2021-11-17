<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Supplier Data Input Form</h1>
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
                <h3 class="card-title">Add Supplier</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form @submit.prevent="addSupplier">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.title"
                        name="title"
                        placeholder="Supplier name"
                      />
                      <p v-if="erros.title" class="text-danger"> {{ erros.title[0] }}</p>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="mobile">Mobile</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.mobile"
                        name="mobile"
                        placeholder="Mobile number"
                      />
                      <p v-if="erros.mobile" class="text-danger"> {{ erros.mobile[0] }}</p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="address">Address</label>
                    <input
                      type="text"
                      class="form-control"
                      name="address"
                      v-model="form.address"
                      placeholder="1234 Main St"
                    />
                    <p v-if="erros.address" class="text-danger"> {{ erros.address[0] }}</p>
                  </div>

                  <button type="submit" class="btn btn-primary">Save</button>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6"></div>
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
    //Comes form helpers
    if (!User.loggedIn()) {
      this.$router.push("/");
    }
  },
  //Data property
  data() {
    return {
      form: {
        title: null,
        address: null,
        mobile: null,
      },
      erros: [],
    };
  },
  //Methods here
  methods: {
    addSupplier() {
      axios
        .post("/api/supplier", this.form)
        .then((response) => {
          //console.log(response.data);
          this.$router.push("suppliers");
          //Toast message
          Notifications.success();
        })
        .catch((error) => {
          //console.log(error);
          this.erros = error.response.data.errors;
          Notifications.error();
        });
    },
  },
};

$(document).ready(function () {
  $("#errorTitle").alert();
  window.setTimeout(function () {
    $("#errorTitle").alert("close");
  }, 2000);
  $("#errorMobile").alert();
  $;
  window.setTimeout(function () {
    $("#errorMobile").alert("close");
  }, 2000);

  $("#errorAddress").alert();
  window.setTimeout(function () {
    $("#errorAddress").alert("close");
  }, 2000);
});
</script>

<style scoped>
</style>
