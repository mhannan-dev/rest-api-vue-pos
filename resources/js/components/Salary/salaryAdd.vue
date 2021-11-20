<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Salary Payment</h1>
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
                <h3 class="card-title">Salary Payment</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form
                  @submit.prevent="addProduct"
                  enctype="multipart/form-data"
                >
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Select Employee</label>
                      <select class="form-control" v-model="form.employee_id">
                        <option value="" selected>Select Employee</option>
                        <option value="">Employee One</option>
                        <option value="">Employee One</option>
                        <option value="">Employee One</option>
                        <option value="">Employee One</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Salary month</label>
                      <select class="form-control" v-model="form.month">
                        <option value="jan">Janaury</option>
                        <option value="feb">February</option>
                        <option value="mar">March</option>
                        <option value="apr">April</option>
                        <option value="may">May</option>
                        <option value="june">June</option>
                        <option value="july">July</option>
                        <option value="aug">August</option>
                        <option value="sep">September</option>
                        <option value="oct">October</option>
                        <option value="nov">November</option>
                        <option value="dec">December</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleFormControlSelect1"
                        >Year</label
                      >
                      <input v-model="form.year" class="form-control" placeholder="2018"/>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="amount">Amount</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Enter salary amt"
                        v-model="form.amount"
                      />
                      <p v-if="erros.amount" class="text-danger">
                        {{ erros.amount[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="payment_date">Payment date</label>
                      <input
                        type="text"
                        id="datepicker"
                        class="form-control"
                        v-model="form.payment_date"
                        placeholder="select payment date"
                      />
                      <p v-if="erros.payment_date" class="text-danger">
                        {{ erros.payment_date[0] }}
                      </p>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">
                    Salary Payment
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
  //Data property
  data() {
    return {
      form: {
        category_id: null,
        supplier_id: null,
        title: null,
        code: null,
        root: null,
        buying_price: null,
        selling_price: null,
        product_image: null,
        buying_quantity: null,
        buying_date: null,
      },
      erros: [],
      categories: [],
      suppliers: [],
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
          this.form.product_image = event.target.result;
          //console.log(event.target.result);
        };
        reader.readAsDataURL(file);
      }
    },
    addProduct() {
      axios
        .post("/api/product", this.form)
        .then((response) => {
          //Redirect to employees
          this.$router.push({ name: "products" });
          //Toast message
          Notifications.success();
        })
        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
    loadCategories() {
      //Collect category
      axios.get("/api/category/").then(
        ({ data }) =>
          //console.log(data)
          (this.categories = data)
      );
    },
    loadSuppliers() {
      //Collect supplier
      axios.get("/api/supplier/").then(({ data }) => (this.suppliers = data));
    },
  },
  mounted() {
    this.loadCategories();
    this.loadSuppliers();
  },
};
</script>

<style scoped>
</style>
