<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Stock</h1>
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
                <h3 class="card-title">Update Stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form @submit.prevent="updateProductStock">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="product_quantity">Product quantity</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Enter product quantity"
                        v-model="form.buying_quantity"
                      />
                      <p v-if="erros.buying_quantity" class="text-danger">
                        {{ erros.buying_quantity[0] }}
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
        buying_quantity: "",
      },
      erros: [],
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/product/" + id)
      .then(
        ({ data }) =>
          // console.log(data)
          (this.form = data)
      )
      .catch(() => {
        console.log("error");
      });
  },

  //Methods here
  methods: {
    updateProductStock() {
      let id = this.$route.params.id;
      axios.post("/api/product-stock-update/" + id, this.form)
        .then((response) => {
          this.$router.push({ name: "stock" });
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
