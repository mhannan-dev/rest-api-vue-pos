<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pay Employee Salary</h1>
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
                <h3 class="card-title">Pay Salary</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form @submit.prevent="salaryPayment">
                  <div class="form-row">
                    <div class="form-group col-md-3">
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
                    <div class="form-group col-md-3">
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
                    <div class="form-group col-md-3">
                      <label for="">Salary month</label>
                      <select class="form-control" v-model="form.month">
                        <option value="">Select month</option>
                        <option value="January">Janaury</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                      </select>
                      <p v-if="erros.month" class="text-danger">
                        {{ erros.month[0] }}
                      </p>
                    </div>

                    <div class="form-group col-md-3">
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
        name: "",
        email: "",
        month: "",
        amount: "",
      },
      erros: [],
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/employee/" + id)
      .then(({ data }) => (this.form = data))
      .catch(() => {
        console.log("error");
      });
  },

  //Methods here
  methods: {
    salaryPayment() {
      let emp_id = this.$route.params.id;
      axios
        .post(`/api/salary/paid/` + emp_id, this.form)
        .then((response) => {
          this.$router.push({ name: "employeeSheet" });
          //Toast message
          Notifications.success();
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
