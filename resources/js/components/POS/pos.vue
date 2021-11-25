<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Monthly Racap Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Qty</th>
                      <th>Unit</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>X</td>
                      <td>Software</td>
                      <td>X</td>
                      <td>X</td>
                      <td>X</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <td>Total quantity</td>
                      <td>550</td>
                    </tr>
                    <tr>
                      <td>Subtotal</td>
                      <td>550</td>
                    </tr>
                    <tr>
                      <td>Vat</td>
                      <td>550</td>
                    </tr>
                    <tr>
                      <td>Total</td>
                      <td>550</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-primary">
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Name</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option v-for="(customer, index) in customers"
                  :key="index">{{ customer.name }}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Payment Amount</label>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Payment Amount"
                    />
                  </div>
                  <div class="form-group">
                    <label for="due_amount">Due Amount</label>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Due Amount"
                    />
                  </div>
                  <div class="form-group">
                    <label for="payment_mode">Payment Mode</label>
                    <select class="form-control">
                      <option value="cash">Cash</option>
                      <option value="chqeue">Cheque</option>
                      <option value="mobile_wallet">Mobile Wallet</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products Sold</h3>
              </div>
              <!-- /.card-header -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link active"
                    id="home-tab"
                    data-toggle="tab"
                    href="#home"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                    >All Products</a
                  >
                </li>

                <li
                  class="nav-item"
                  role="presentation"
                  v-for="(category, index) in categories"
                  :key="index"
                >
                  <a
                    class="nav-link"
                    id="contact-tab"
                    data-toggle="tab"
                    href="#contact"
                    role="tab"
                    aria-controls="contact"
                    aria-selected="false"
                    @click="subProducts(category.id)"
                    >{{ category.category_name }}</a
                  >
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div
                  class="tab-pane fade show active"
                  id="home"
                  role="tabpanel"
                  aria-labelledby="home-tab"
                >
                  <div class="card-body">
                    <input
                      type="text"
                      class="form-control mb-2"
                      placeholder="Search product"
                      v-model="searchTerm"
                    />

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Product</th>
                          <th>Status</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(product, index) in filterSearch"
                          :key="index"
                        >
                          <td>{{ ++index }}</td>
                          <td>{{ product.title }}</td>
                          <td>
                            <span
                              class="badge badge-success"
                              v-if="product.buying_quantity >= 1"
                              >Avaliable</span
                            >
                            <span class="badge badge-warning" v-else
                              >Stock Out</span
                            >
                          </td>
                          <td>{{ product.selling_price }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div
                  class="tab-pane fade"
                  id="contact"
                  role="tabpanel"
                  aria-labelledby="contact-tab"
                >
                  <div class="card-body">
                    <input
                      type="text"
                      class="form-control mb-2"
                      placeholder="Search category product"
                      v-model="filterSearchTerm"
                    />

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Product</th>
                          <th>Status</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(getProduct, index) in filterCatPrd"
                          :key="index"
                        >
                          <td>{{ ++index }}</td>
                          <td>{{ getProduct.title }}</td>
                          <td>
                            <span
                              class="badge badge-success"
                              v-if="getProduct.buying_quantity >= 1"
                              >Avaliable</span
                            >
                            <span class="badge badge-warning" v-else
                              >Stock Out</span
                            >
                          </td>
                          <td>{{ getProduct.selling_price }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
</template>
<script>
export default {
  created() {
    //Comes form helpers
    if (!User.loggedIn()) {
      this.$router.push("/");
    }
  },
  data() {
    return {
      products: [],
      categories: "",
      customers: "",
      getProducts: [],
      filterSearchTerm: "",
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.products.filter((product) => {
        return product.title.match(this.searchTerm);
      });
    },
    filterCatPrd() {
      return this.getProducts.filter((getProduct) => {
        return getProduct.title.match(this.filterSearchTerm);
      });
    },
  },
  methods: {
    loadProducts() {
      axios
        .get("api/product")
        .then((res) => {
          this.products = res.data.data;
        })
        .catch((error) => console.log(error.data));
    },
    loadCategories() {
      axios
        .get("api/category")
        .then((data) => {
          this.categories = data.data;
        })
        .catch((error) => console.log(error.data));
    },
    subProducts(id) {
      axios
        .get("api/gettting-products/" + id)
        .then((data) => {
          //console.log(data);
          this.getProducts = data.data;
        })
        .catch((error) => console.log(error.data));
    },
    loadCustomers() {
      axios
        .get("api/customer")
        .then((data) => {
          //console.log(data);
          this.customers = data.data;
        })
        .catch((error) => console.log(error.data));
    },
  },
  created() {
    this.loadProducts();
    this.loadCategories();
    this.subProducts();
    this.loadCustomers();
  },
};
</script>

<style scoped>
</style>
