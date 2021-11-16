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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employees</h3>
                <router-link
                  to="/employee-add"
                  class="btn btn-success float-right"
                >
                  <i class="nav-icon fas fa-plus-circle"></i> Add
                </router-link>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div
                  id="example2_wrapper"
                  class="dataTables_wrapper dt-bootstrap4"
                >
                  <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <table
                        class="
                          table table-bordered table-hover
                          dataTable
                          dtr-inline
                        "
                        role="grid"
                        aria-describedby="example2_info"
                      >
                        <thead>
                          <tr role="row">
                            <th
                              class="sorting_asc"
                              tabindex="0"
                              aria-controls="example2"
                              rowspan="1"
                              colspan="1"
                              aria-sort="ascending"
                              aria-label="Rendering engine: activate to sort column descending"
                            >
                              Rendering engine
                            </th>
                            <th
                              class="sorting"
                              tabindex="0"
                              aria-controls="example2"
                              rowspan="1"
                              colspan="1"
                              aria-label="Browser: activate to sort column ascending"
                            >
                              Browser
                            </th>
                            <th
                              class="sorting"
                              tabindex="0"
                              aria-controls="example2"
                              rowspan="1"
                              colspan="1"
                              aria-label="Platform(s): activate to sort column ascending"
                            >
                              Platform(s)
                            </th>
                            <th
                              class="sorting"
                              tabindex="0"
                              aria-controls="example2"
                              rowspan="1"
                              colspan="1"
                              aria-label="Engine version: activate to sort column ascending"
                            >
                              Engine version
                            </th>
                            <th
                              class="sorting"
                              tabindex="0"
                              aria-controls="example2"
                              rowspan="1"
                              colspan="1"
                              aria-label="CSS grade: activate to sort column ascending"
                            >
                              CSS grade
                            </th>
                          </tr>
                        </thead>
                        <tbody v-if="employees.length">
                        <tr v-for="employee in employees" :key="employee.id">
                            <td>
                              {{ employee.id }}
                            </td>
                            <td>{{ employee.name }}</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.7</td>
                            <td>A</td>
                          </tr>

                        </tbody>
                        <tbody v-else>
                                <tr>
                                    <td colspan="5">
                                        <h5 class="text-center mt-4 mb-4">No employee found.</h5>
                                    </td>
                                </tr>
                            </tbody>

                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-5">
                      <div
                        class="dataTables_info"
                        id="example2_info"
                        role="status"
                        aria-live="polite"
                      >
                        Showing 1 to 10 of 57 entries
                      </div>
                    </div>
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
                          <li class="paginate_button page-item">
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="3"
                              tabindex="0"
                              class="page-link"
                              >3</a
                            >
                          </li>
                          <li class="paginate_button page-item">
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="4"
                              tabindex="0"
                              class="page-link"
                              >4</a
                            >
                          </li>
                          <li class="paginate_button page-item">
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="5"
                              tabindex="0"
                              class="page-link"
                              >5</a
                            >
                          </li>
                          <li class="paginate_button page-item">
                            <a
                              href="#"
                              aria-controls="example2"
                              data-dt-idx="6"
                              tabindex="0"
                              class="page-link"
                              >6</a
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
    <!-- Large modal -->
    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Large Modal</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
</template>

<script>
export default {
  created() {
    //Comes form helpers - checking loggedin or not
    if (!User.loggedIn()) {
      //Redirect to dashboard route
      this.$router.push("/");
    }
  },
  data() {
    return {
      employees: [],
    };
  },
  methods: {
    loadEmployees() {
      axios
        .get("/api/employee")
        .then((response) => {
          this.employees = response.data;
        })
        .catch((error) => {
          console.error("The Promise is rejected!", error);
        });
    },
  },
};
</script>

<style scoped>
</style>
