<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Update Product</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form
                  @submit.prevent="updateProduct"
                  enctype="multipart/form-data"
                >
                  <input type="hidden" name="_method" value="PATCH" />
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="">Select Product Category</label>
                      <select class="form-control" v-model="form.category_id">
                        <option style="display: none" value="" selected>
                          Select Category
                        </option>
                        <option
                          :value="category.id"
                          v-for="category in categories"
                          :key="category.id"
                        >
                          {{ category.category_name }}
                        </option>
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="exampleFormControlSelect1"
                        >Supplier select</label
                      >
                      <select class="form-control" v-model="form.supplier_id">
                        <option style="display: none" value="" selected>
                          Select Category
                        </option>
                        <option
                          :value="supplier.id"
                          v-for="(supplier, index) in suppliers"
                          :key="index"
                        >
                          {{ supplier.title }}
                        </option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Enter Product Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter Product Name"
                        v-model="form.title"
                      />
                      <p v-if="erros.title" class="text-danger">
                        {{ erros.title[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Root</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter product root"
                        v-model="form.root"
                      />
                      <p v-if="erros.root" class="text-danger">
                        {{ erros.root[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="product_code">Enter Product Code</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter product code"
                        v-model="form.code"
                      />
                      <p v-if="erros.code" class="text-danger">
                        {{ erros.code[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="buying_price">Buying Price</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Enter Buying Price"
                        v-model="form.buying_price"
                      />
                      <p v-if="erros.buying_price" class="text-danger">
                        {{ erros.buying_price[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="selling_price">Selling price</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Enter selling price"
                        v-model="form.selling_price"
                      />
                      <p v-if="erros.selling_price" class="text-danger">
                        {{ erros.selling_price[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="product_quantity">Product quantity</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Enter product quantity"
                        v-model="form.buying_quantity"
                      />
                      <p v-if="erros.buying_quantity" class="text-danger">
                        {{ erros.buying_quantity[0] }}
                      </p>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="inputEmail4">Image</label>
                      <input
                        type="file"
                        class="form-control"
                        @change="onFileSelected"
                        accept="image/*"
                      />
                      <p v-if="erros.product_image" class="text-danger">
                        {{ erros.product_image[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="picture">Image Preview</label> <br />
                      <img
                        alt="Image"
                        style="hieght: 100px; width: 100px"
                        :src="form.product_image"
                      />
                    </div>
                    <div class="form-group col-md-4">
                      <label for="buying_date">Buying date</label>
                      <input
                        type="text"
                        id="datepicker"
                        class="form-control"
                        v-model="form.buying_date"
                      />
                      <p v-if="erros.buying_date" class="text-danger">
                        {{ erros.buying_date[0] }}
                      </p>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">
                    Save product
                  </button>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12"></div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
</template>

<script type="text/javascript">
export default {
  created() {
    //Comes form helpers - checking loggedin or not
    if (!User.loggedIn()) {
      this.$router.push("/");
    }
  },
  //Data property
  data() {
    return {
      form: {
        category_id: "",
        supplier_id: "",
        title: "",
        code: "",
        root: "",
        buying_price: "",
        selling_price: "",
        product_image: "",
        buying_quantity: "",
        buying_date: "",
        newImage: "",
      },
      erros: [],
      categories: [],
      suppliers: [],
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/product/" + id)
      .then(({ data }) =>
       // console.log(data)
        this.form = data
      )
      .catch(() => {
        console.log("error");
      });
    //Collect category
    axios.get("/api/category/").then(({ data }) =>
      //console.log(data)
      this.categories = data
    );
    //Collect supplier
    axios.get("/api/supplier/").then(({ data }) =>
      //console.log(data)
      this.suppliers = data
    );
  },

  //Methods here
  methods: {
    onFileSelected(e) {
      const file = e.target.files[0];
      // Do some client side validation...
      if (file.size > 1048770) {
        Notifications.imageValidation();
      } else {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.newImage = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    updateProduct() {
      axios
        .patch(`/api/product/${this.$route.params.id}`, this.form)
        .then((response) => {
          this.$router.push({ name: "products" });
          //Toast message
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
