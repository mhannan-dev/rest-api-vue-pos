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
          <!-- /.col -->
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
              placeholder="Search data"
              v-model="searchTerm"
            />
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Suppliers</h3>
                <router-link
                  to="/supplier-add"
                  class="btn btn-success float-right"
                >
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  Supplier</router-link
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
                          <tr role="row">
                            <th>SL</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody v-if="suppliers.length">
                          <tr v-for="supplier in filterSearch" :key="supplier.id">
                            <td class="dtr-control sorting_1" tabindex="0">
                              {{ supplier.id }}
                            </td>
                            <td>{{ supplier.title }}</td>
                            <td>{{ supplier.mobile }}</td>
                            <td>{{ supplier.address }}</td>
                            <td>
                               <router-link :to="{name: 'supplierEdit', params: {id: supplier.id}}" class="btn btn-primary btn-sm">
                                   <i class="fas fa-edit"></i>
                               </router-link>

                               <button
                                @click.prevent="deleteItem(supplier)"
                                class="btn btn-danger btn-sm"
                              >
                                <i class="fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                        <tbody v-else>
                          <tr>
                            <td colspan="6">
                              <h5 class="text-center mt-4 mb-4">
                                No data found.
                              </h5>
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
      //Redirect to dashboard route
      this.$router.push("/");
    }
  },
  data() {
    return {
      suppliers: [],
      searchTerm: ''
    };
  },
  computed:{
      filterSearch(){
          return this.suppliers.filter(supplier =>{
              return supplier.mobile.match(this.searchTerm)
          })
      }
  },
  methods: {
    loadSuppliers() {
      axios
        .get("/api/supplier")
        .then((data) => {
          this.suppliers = data.data;
        })
        .catch((error) => console.log(error.data));
    },
    deleteItem(supplier) {
      axios.delete(`/api/supplier/${supplier.id}`).then(() => {
        this.$toast.success({
          title: "Success!",
          message: "Supplier deleted successfully.",
        });
      });
      let index = this.suppliers.indexOf(supplier);
      this.suppliers.splice(index, 1);
    },
  },
  created() {
    this.loadSuppliers();
  },
};
</script>

<style scoped>
</style>
