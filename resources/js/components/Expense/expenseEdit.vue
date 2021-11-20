<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Expense</h1>
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
                <h3 class="card-title">Add Expense</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form @submit.prevent="updateExpense">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="details">Expense Details</label>
                      <textarea class="form-control" v-model="form.details" rows="2" placeholder="Paid against XYZ"></textarea>
                      <p v-if="erros.details" class="text-danger">
                        {{ erros.details[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="amount">Amount</label>
                      <input
                        type="number"
                        v-model="form.amount"
                        class="form-control"
                        placeholder="Expense amount"
                      />
                      <p v-if="erros.amount" class="text-danger">
                        {{ erros.amount[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-6">
                       <label for="expense_date">Expense Date</label>
                       <input type="text" id="datepicker" class="form-control" v-model="form.expense_date" placeholder="Select Date">
                       <p v-if="erros.expense_date" class="text-danger">
                        {{ erros.expense_date[0] }}
                      </p>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">
                    Save
                  </button>
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
    //Comes form helpers
    if (!User.loggedIn()) {
      this.$router.push("/");
    }
  },
  data() {
    return {
      form: {
        details: "",
        expense_date: "",
        amount: ""
      },
      erros: [],
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/expense/" + id)
      .then(({ data }) => (this.form = data))
      .catch(() => {
        console.log("error");
      });
  },

  //Methods here
  methods: {
    updateExpense() {
      axios.patch(`/api/expense/${this.$route.params.id}`, this.form)
        .then((response) => {
          this.$router.push({ name: "expenses" });
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

