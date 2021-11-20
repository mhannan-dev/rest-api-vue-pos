<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advanced Form</h1>
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
                <h3 class="card-title">Add Employee</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form
                  method="post"
                  @submit.prevent="addEmployee"
                  enctype="multipart/form-data"
                >
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
                    <div class="form-group col-md-4">
                      <label for="salary">Salary</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Enter salary amount"
                        name="salary"
                        v-model="form.salary"
                      />
                      <p v-if="erros.salary" class="text-danger">
                        {{ erros.salary[0] }}
                      </p>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputZip">NID</label>
                      <input
                        type="number"
                        class="form-control"
                        name="nid"
                        placeholder="Enter NID No"
                        v-model="form.nid"
                      />
                      <p v-if="erros.nid" class="text-danger">
                        {{ erros.nid[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
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

                    <div class="form-group col-md-4">
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
                    <div class="form-group form-row col-md-4">
                      <label for="photo">Photo</label>
                      <input
                        type="file"
                        class="form-control"
                        name="image"
                        @change="onFileSelected"
                        accept="image/*"
                      />
                      <p v-if="erros.image" class="text-danger">
                        {{ erros.image[0] }}
                      </p>
                    </div>
                    <img
                      :src="form.image"
                      height="80px"
                      class="img-fluid m-2"
                      width="80px;"
                    />
                    <div class="form-group col-md-4">
                       <label for="address">Joining date</label>
                       <input type="text" id="datepicker" class="form-control" v-model="form.joining_date" name="joining_date">
                       <p v-if="erros.joining_date" class="text-danger">
                        {{ erros.joining_date[0] }}
                      </p>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">Save</button>
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
        salary: null,
        address: null,
        nid: null,
        joining_date: null,
        image: null,
      },
      erros: [],
    };
  },
  //Methods here
  methods: {
    onFileSelected(e) {
      const file = e.target.files[0];
      // Do some client side validation...
      if (file.size > 1048770) {
        Notifications.imageValidation();
      } else {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.image = event.target.result;
          //console.log(event.target.result);
        };
        reader.readAsDataURL(file);
      }
    },
    addEmployee() {
      axios
        .post("/api/employee", this.form)
        .then((response) => {
          //console.log(response.data);
          //Redirect to employees
          //Toast message
          Notifications.success();
          this.$router.push("employees");
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
