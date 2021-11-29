<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item">Name: {{ orders.name }}</li>
                  <li class="list-group-item">Mobile: {{ orders.mobile }}</li>
                  <li class="list-group-item">Address: {{ orders.address }}</li>
                  <li class="list-group-item">Date: {{ orders.order_date }}</li>
                  <li class="list-group-item">Payment Through: {{ orders.pay_by }}</li>

                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
           <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item">Subtotal: {{ orders.sub_total }}</li>
                  <li class="list-group-item">Vat: {{ orders.vat_amount }}%</li>
                  <li class="list-group-item">Total: {{ orders.total }}</li>
                  <li class="list-group-item">Payment amount: {{ orders.pay_amount }}</li>
                  <li class="list-group-item">Due amount: {{ orders.due_amount }}</li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px">
                    <input
                      type="text"
                      name="table_search"
                      class="form-control float-right"
                      placeholder="Search"
                    />
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Product name</th>
                      <th>Code</th>
                      <th>Qty</th>
                      <th>Product price</th>
                      <th>Sub total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(detail, index) in details" :key="index">
                      <td>{{ detail.title }}</td>
                      <td>{{ detail.code }}</td>
                      <td>{{ detail.product_qty }}</td>
                      <td>{{ detail.product_price }}</td>
                      <td>{{ detail.sub_total }}</td>

                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
      orders: [],
      details: [],
    };
  },
  created() {
    //*************
    let id = this.$route.params.id;
    axios
      .get("/api/order-details/" + id)
      .then((data) => {
        //console.log(data);
        this.orders = data.data;
      })
      .catch((error) => console.log(error));
    //*************
    axios
      .get("/api/order-order_details/" + id)
      .then((data) => {
        //console.log(data);
        this.details = data.data;
      })
      .catch((error) => console.log(error));
  },
};
</script>
<style scoped>
</style>
