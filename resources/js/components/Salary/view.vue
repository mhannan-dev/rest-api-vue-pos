<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link to="/salary" class="m-0">Go Back</router-link>
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
            />
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee salary details</h3>
                <router-link
                  to="/employee-add"
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
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Salary Month of</th>
                            <th class="th-sm">Paid on</th>
                            <th class="th-sm">Action</th>
                          </tr>
                        </thead>

                        <tbody v-if="salaries.length">
                          <tr v-for="(salary, index) in filterSearch" :key="index">
                            <td>{{ salary.name }}</td>
                            <td>{{ salary.month }}</td>
                            <td>{{ salary.payment_date }}</td>
                            <td>
                              <router-link
                                :to="{
                                  name: 'edit-salary',
                                  params: { id: salary.id },
                                }"
                                class="btn btn-success btn-sm"
                              >
                               Edit Salary
                              </router-link>
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
      salaries: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.salaries.filter((salary) => {
        return salary.name.match(this.searchTerm);
      });
    },
  },
  methods: {
    viewSalary() {
      let id = this.$route.params.id;
      axios
        .get("/api/salary/view/" + id)
        .then((data) => {
           //console.log(data.data);
           this.salaries = data.data;
        })

        .catch((error) => {
          this.erros = error.response.data.errors;
        });
    },
  },
  created() {
    this.viewSalary();
  },
};
</script>

<style scoped>
</style>
