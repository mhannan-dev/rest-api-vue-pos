<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">POS</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">POS v1</li>
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
                <router-link
                  to="/customer-add"
                  class="btn btn-success float-right"
                >
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  Customer</router-link
                >
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Qty</th>
                      <th>Selling Price</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(cartProduct, index) in cartProducts"
                      :key="index"
                    >
                      <td>{{ cartProduct.product_name }}</td>
                      <td>
                        <input
                          style="width: 20px"
                          type="text"
                          :value="cartProduct.product_qty"
                          readonly
                        />
                        <button class="btn btn-success btn-sm">+</button>
                        <button class="btn btn-warning btn-sm">-</button>
                      </td>
                      <td>{{ cartProduct.product_price }}</td>
                      <td>{{ cartProduct.sub_total }}</td>
                      <td>
                        <button
                          @click.prevent="removeCartProduct(cartProduct.id)"
                          class="btn btn-danger btn-sm"
                        >
                          <i class="fas fa-minus-circle"></i>
                        </button>
                      </td>
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
            <form action="">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Customer Name</label>
                      <select
                        class="form-control"
                        id="exampleFormControlSelect1"
                      >
                        <option value="">Select customer</option>
                        <option
                          v-for="(customer, index) in customers"
                          :key="index"
                        >
                          {{ customer.name }}
                        </option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Payment Amount</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Payment Amount"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="due_amount">Due Amount</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Due Amount"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label for="payment_mode">Payment Mode</label>
                      <select class="form-control">
                        <option value="">Select option</option>
                        <option value="cash">Cash</option>
                        <option value="chqeue">Cheque</option>
                        <option value="mobile_wallet">Mobile Wallet</option>
                      </select>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
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
                    <div class="row">
                      <div
                        class="col-md-3"
                        v-for="(product, index) in filterSearch"
                        :key="index"
                      >
                        <figure class="card card-product">
                          <img
                            class="img-fluid"
                            :src="product.product_image"
                            id="productPhoto"
                            alt="image"
                          />
                          <figcaption class="info-wrap">
                            <h6 class="title">{{ product.title }}</h6>
                          </figcaption>
                          <div class="bottom-wrap">
                            <button
                              class="btn btn-outline-success btn-sm btn-block"
                              @click.prevent="addToCart(product.id)"
                            >
                              Add to cart
                            </button>
                            <button class="btn btn-success btn-sm btn-block">
                              BDT. {{ product.selling_price }}
                            </button>
                          </div>
                          <!-- bottom-wrap.// -->
                        </figure>
                      </div>
                    </div>
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
                    <div class="row">
                      <div
                        class="col-md-3"
                        v-for="(getProduct, index) in filterCatPrd"
                        :key="index"
                      >
                        <figure class="card card-product">
                          <img
                            class="img-fluid"
                            :src="getProduct.product_image"
                            id="productPhoto"
                            alt="image"
                          />
                          <figcaption class="info-wrap">
                            <h6 class="title">Product name</h6>
                          </figcaption>
                          <div class="bottom-wrap">
                            <button
                              class="btn btn-outline-success btn-sm btn-block"
                              @click.prevent="addToCart(product.id)"
                            >
                              Add to cart
                            </button>
                            <button class="btn btn-success btn-sm btn-block">
                              {{ getProduct.selling_price }}
                            </button>
                          </div>
                          <!-- bottom-wrap.// -->
                        </figure>
                      </div>
                    </div>
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
  created() {
    this.loadProducts();
    this.loadCategories();
    this.subProducts();
    this.loadCustomers();
    this.loadCartProducts();
    Reload.$on("AfterAddReload", () => {
      this.loadCartProducts();
    });
  },
  data() {
    return {
      products: [],
      categories: "",
      customers: "",
      getProducts: [],
      filterSearchTerm: "",
      searchTerm: "",
      cartProducts: [],
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
    //Remove cart product
    removeCartProduct(id) {
      axios
        .get("/api/remove-cart-product/" + id)
        .then(() => {
          Reload.$emit("AfterAddReload");
          Notifications.cart_delete();
        })
        .catch((error) => console.log(error.res));
    },
    //Cart
    addToCart(id) {
      axios
        .get("/api/add-to-cart/" + id)
        .then(() => {
          Reload.$emit("AfterAddReload");
          Notifications.cart_success();
        })
        .catch((error) => console.log(error.res));
    },
    //Cart products
    loadCartProducts() {
      axios
        .get("api/cart-product")
        .then((data) => {
          //console.log(data);
          this.cartProducts = data.data;
        })
        .catch((error) => console.log(error.data));
    },
    //products
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
};
</script>

<style scoped>
.card-product .img-wrap {
  border-radius: 3px 3px 0 0;
  overflow: hidden;
  position: relative;
  height: 220px;
  text-align: center;
}
.card-product .img-wrap img {
  max-height: 100%;
  max-width: 100%;
  object-fit: cover;
}
.card-product .info-wrap {
  overflow: hidden;
  padding: 15px;
  border-top: 1px solid #eee;
}
.card-product .bottom-wrap {
  padding: 15px;
  border-top: 1px solid #eee;
}

.label-rating {
  margin-right: 10px;
  color: #333;
  display: inline-block;
  vertical-align: middle;
}

.card-product .price-old {
  color: #999;
}
</style>
