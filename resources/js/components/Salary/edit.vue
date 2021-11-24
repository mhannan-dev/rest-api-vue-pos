<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Employee Salary</h1>
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
                <form @submit.prevent="updateSalary">

                  <input type="hidden" v-model="form.employee_id">
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
                        v-model="form.amount"
                      />
                      <p v-if="erros.amount" class="text-danger">
                        {{ erros.amount[0] }}
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
        employee_id: ""
      },
      erros: [],
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/salary/edit/" + id)
      .then((data) => {
        //   console.log(data);
        this.form = data.data;
      })
      .catch((err) => {
        console.log("error");
      });
  },
  //Methods here
  methods: {
    updateSalary() {
      let id = this.$route.params.id;
      axios.post("/api/salary/update/" + id, this.form)
        .then((response) => {
          this.$router.push({ name: "allSalary" });
          Notifications.success();
        })
        .catch((error) => {
          this.erros = error;
        });
    },
  },
};
</script>

<style scoped>
</style>
