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
          <div class="col-md-3 mb-2">
            <input
              type="text"
              class="form-control"
              placeholder="Search Employee Name"
              v-model="searchTerm"
            />
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">products</h3>
                <router-link
                  to="/product-add"
                  class="btn btn-success float-right"
                >
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  Employee</router-link
                >
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div
                  id="example2_wrapper"
                  class="dataTables_wrapper dt-bootstrap4"
                >
                  <div class="row">
                    <div class="col-sm-12">
                      <table
                        id="dtBasicExample"
                        class="table table-striped table-bordered table-sm"
                        cellspacing="0"
                        width="100%"
                      >
                        <thead>
                          <tr>
                            <th class="th-sm">ID</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Code</th>
                            <th class="th-sm">Category</th>
                            <th class="th-sm">Supplier</th>
                            <th class="th-sm">Buy</th>
                            <th class="th-sm">Sell Price</th>
                            <th class="th-sm">Status</th>
                            <th class="th-sm">Quantity</th>
                            <th class="th-sm">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr
                            v-for="(product, index) in filterSearch"
                            :key="index"
                          >
                            <td>{{ ++index }}</td>
                            <td>{{ product.title }}</td>
                            <td>{{ product.code }}</td>
                            <td>{{ product.category.category_name }}</td>
                            <td>{{ product.supplier.title }}</td>
                            <td>{{ product.buying_price }}</td>
                            <td>{{ product.selling_price }}</td>
                            <td>
                              <span class="badge badge-success" v-if="product.buying_quantity >= 1 ">Avaliable</span>
                              <span class="badge badge-warning" v-else>Stock Out</span>
                            </td>
                            <td>
                              {{ product.buying_quantity }}
                            </td>

                            <td>
                              <router-link
                                :to="{
                                  name: 'updateStock',
                                  params: { id: product.id },
                                }"
                                class="btn btn-primary btn-sm" title="Update Stock"
                              >
                                <i class="fas fa-edit"></i>
                              </router-link>


                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-7">
                      <div
                        class="dataTables_paginate paging_simple_numbers"
                        id="example2_paginate"
                      >
                        <ul class="pagination">
                          <li
                            class="paginate_button page-item previous disabled"
                            id="example2_previous"
                          >
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="0"
                              tabindex="0"
                              class="page-link"
                              >Previous</a
                            >
                          </li>
                          <li class="paginate_button page-item active">
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="1"
                              tabindex="0"
                              class="page-link"
                              >1</a
                            >
                          </li>
                          <li class="paginate_button page-item">
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="2"
                              tabindex="0"
                              class="page-link"
                              >2</a
                            >
                          </li>

                          <li
                            class="paginate_button page-item next"
                            id="example2_next"
                          >
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="7"
                              tabindex="0"
                              class="page-link"
                              >Next</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.products.filter((product) => {
        return product.title.match(this.searchTerm);
      });
    },
  },
  methods: {
    loadProducts() {
      axios.get("api/product")
        .then((res) => {
          //console.log(data);
          this.products = res.data.data;
        })
        .catch((error) => console.log(error.data));
    },

  },
  created() {
    this.loadProducts();
  },
};
</script>

<style scoped>
</style>
