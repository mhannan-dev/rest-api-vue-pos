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
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form @submit.prevent="addCategory">
                  <div class="form-row">

                    <div class="form-group col-md-4">
                      <label for="category_name">Category Name</label>
                      <input
                        type="text"
                        v-model="form.category_name"
                        class="form-control"
                        placeholder="Category name"
                      />

                      <p v-if="erros.category_name" class="text-danger">
                        {{ erros.category_name[0] }}
                      </p>
                    </div>

                  </div>
                  <button type="submit" class="btn btn-success">
                    Save
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
  //Data property
  data() {
    return {
      form: {
        category_name: null
      },
      erros: [],
    };
  },
  //Methods here
  methods: {
    addCategory() {
      axios.post("/api/category", this.form)
        .then((response) => {
          this.$router.push({ name: "categories" });
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
