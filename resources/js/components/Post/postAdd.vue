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
                <h3 class="card-title">Add Post</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form @submit.prevent="addPost" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Enter Image Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter name"
                        v-model="form.title"
                        name="title"
                      />
                      <p v-if="erros.title" class="text-danger">
                        {{ erros.title[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Image</label>
                      <input
                        type="file"
                        name="image"
                        class="form-control"
                        @change="onFileSelected"
                        accept="image/*"
                      />

                      <p v-if="erros.image" class="text-danger">
                        {{ erros.image[0] }}
                      </p>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="picture">Image Preview</label> <br>
                      <img :src="form.image" alt="Image" style="hieght:80px; width: 80px;">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">
                    Save Post
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
        title: null,
        image: null,
      },
      erros: [],
    };
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
          this.form.image = event.target.result;
          //console.log(event.target.result);
        };
        reader.readAsDataURL(file);
      }
    },
    addPost() {
      axios
        .post("/api/post", this.form)
        .then((response) => {
          //Redirect to employees
          this.$router.push({ name: "posts" });
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
