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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>BDT. {{ totalSells }}</h3>
                <p>Total Sales Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>BDT. {{ todayRcvd }}</h3>
                <p>Today Received Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>BDT. {{ todayDue }}</h3>
                <p>Total Due Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>BDT. {{ todayExp }}</h3>
                <p>Total Expense</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Out of stock products</h3>
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
                        id="example2"
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
                              SL
                            </th>
                            <th
                              class="sorting"
                              tabindex="0"
                              aria-controls="example2"
                              rowspan="1"
                              colspan="1"
                              aria-label="Browser: activate to sort column ascending"
                            >
                              Product name
                            </th>

                            <th
                              class="sorting"
                              tabindex="0"
                              aria-controls="example2"
                              rowspan="1"
                              colspan="1"
                              aria-label="Engine version: activate to sort column ascending"
                            >
                              Quantity
                            </th>

                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(product, index) in products"
                            :key="index"
                          >
                            <td>BDT. {{ ++index }}</td>
                            <td>BDT. {{ product.title }}</td>
                            <td>
                              <span class="badge badge-warning" v-if="product.buying_quantity == 0 ">Stock Out</span>

                            </td>

                          </tr>
                        </tbody>
                      </table>
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
        <!-- /.row -->
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
      totalSells: "",
      todayRcvd: "",
      todayDue: "",
      todayExp: "",
      products: "",
    };
  },
  methods: {
    todayTotalSell() {
      axios
        .get("api/today-total-sell")
        .then((data) => {
          //console.log(data);
          this.totalSells = data.data;
        })
        .catch((error) => console.log(error));
    },
    todayRcvdAmount() {
      axios
        .get("api/today-received-amount")
        .then((data) => {
          //console.log(data);
          this.todayRcvd = data.data;
        })
        .catch((error) => console.log(error));
    },
    todayDueAmount() {
      axios
        .get("api/today-due-amount")
        .then((data) => {
          this.todayDue = data.data;
        })
        .catch((error) => console.log(error));
    },
    todayExpAmount() {
      axios
        .get("api/today-expense")
        .then((data) => {
          this.todayExp = data.data;
        })
        .catch((error) => console.log(error));
    },
    stockOut() {
      axios
        .get("api/stockout")
        .then((data) => {
          console.log(data.data);
          this.products = data.data;
        })
        .catch((error) => console.log(error));
    },
  },
  created() {
    this.todayTotalSell();
    this.todayRcvdAmount();
    this.todayDueAmount();
    this.todayExpAmount();
    this.stockOut();
  },
};
</script>
<style scoped>
</style>

