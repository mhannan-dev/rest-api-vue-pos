<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advanced Form</h1>
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
          <div class="col-md-8">
            <form @submit.prevent="searchOrder">
              <div class="row">
                <div class="col">
                  <input
                    type="date"

                    class="form-control"
                    v-model="date"
                    placeholder="Select Date"
                  />
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-primary btn-block">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
        <div class="row mt-2">
          <div class="col-12">
            <div class="card" v-if="orders.length">
              <div class="card-header">
                <h3 class="card-title">Employees</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Sub total</th>
                      <th scope="col">Total</th>
                      <th scope="col">Payment</th>
                      <th scope="col">Due</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(order, index) in orders" :key="index">
                      <td>{{ ++index }}</td>
                      <td>{{ order.name}}</td>
                      <td>{{ order.qty}}</td>
                      <td>{{ order.sub_total}}</td>
                      <td>{{ order.total}}</td>
                      <td>{{ order.pay_amount}}</td>
                      <td>{{ order.due_amount}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <p v-else>No search found</p>


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
</template>

<script type="text/javascript">
export default {
  //Data property
  data() {
    return {
      orders: [],
      date: ""
    };
  },
  //Methods here
  methods: {
    searchOrder() {
      var data = { date: this.date };
      axios
        .post("/api/search-order", data)
        .then((data) => {
          //console.log(data);
          this.orders = data.data;
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
