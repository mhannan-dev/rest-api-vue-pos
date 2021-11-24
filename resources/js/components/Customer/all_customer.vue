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
              placeholder="Search customer Name"
              v-model="searchTerm"
            />
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers</h3>
                <router-link
                  to="/customer-add"
                  class="btn btn-success float-right"
                >
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  Customer</router-link
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
                            <th class="th-sm">Mobile</th>
                            <th class="th-sm">Address</th>

                            <th class="th-sm">Action</th>
                          </tr>
                        </thead>

                        <tbody v-if="customers.length">
                          <tr
                            v-for="(customer, index) in filterSearch"
                            :key="index"
                          >
                            <td>{{ ++index }}</td>
                            <td>{{ customer.name }}</td>
                            <td>{{ customer.mobile }}</td>
                            <td>{{ customer.address }}</td>

                            <td>
                              <router-link
                                :to="{
                                  name: 'customerEdit',
                                  params: { id: customer.id },
                                }"
                                class="btn btn-primary btn-sm"
                              >
                                <i class="fas fa-edit"></i>
                              </router-link>

                              <button
                                @click.prevent="deleteCustomer(customer.id)"
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
                                No item found.
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
      this.$router.push("/");
    }
  },
  data() {
    return {
      customers: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.customers.filter((customer) => {
        return customer.mobile.match(this.searchTerm);
      });
    },
  },
  methods: {
    loadCustomers() {
      axios
        .get("api/customer")
        .then((data) => {
          this.customers = data.data;
        })
        .catch((error) => console.log(error.data));
    },
    deleteCustomer(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("api/customer/" + id)
            .then(() => {
              this.customers = this.customers.filter((customer) => {
                return customer.id != id;
              });
            })
            .catch(() => {
              this.$router.push("customers");
            });
          Swal.fire("Deleted!", "Your data has been deleted.", "success");
        }
      });
    },
  },
  created() {
    this.loadCustomers();
  },
};
</script>

<style scoped>
</style>
