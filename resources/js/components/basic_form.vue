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
                <h3 class="card-title">
                  Quick Example <small>jQuery Validation</small>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Name</label>
                      <input
                        type="name"
                        class="form-control"

                        placeholder="Enter name"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Email</label>
                      <input
                        type="email"
                        class="form-control"

                        placeholder="Enter Email"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label for="salary">Salary</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Enter salary amount"
                      />
                    </div>
                    <div class="form-group col-md-6">
                      <label for="address">Address</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter address"
                      />
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputCity">Photo</label>
                      <input type="text" class="form-control" id="photo" name="photo" />
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputZip">NID</label>
                      <input type="text" class="form-control" name="nid"/>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputZip">Joining Date</label>
                      <input type="text" class="form-control" name="joining_date"/>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success">Sign in</button>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6"></div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
</style>
