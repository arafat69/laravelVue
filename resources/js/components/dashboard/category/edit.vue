<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
              </div>
              <form @submit.prevent="categoryUpdate">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <input type="text" v-model="form.category" class="form-control form-control-sm" name="category" placeholder="Category Name"
                    :class="{ 'is-invalid': form.errors.has('category') }">
                    <has-error :form="form" field="category"></has-error>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <button @click="goBack()" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>
export default {
    name: 'save',
  data: () => ({
     form: new Form({
        category: '',
      })
  }),
  mounted() {
      axios.get('/categoryById/'+this.$route.params.categoryId).then((Response)=>{
          this.form.fill(Response.data.categoryById)
      })
  },

  methods: {
    categoryUpdate () {
      // Submit the form via a POST request
      this.form.post(`/categoryUpdate/${this.$route.params.categoryId}`)
       .then(({ data }) => {
         this.$router.push('/category');
         Toast.fire({
            icon: 'success',
            title: 'Category Update successfully'
            })
        })
    },
     goBack(){
            this.$router.push('/category');
        },

  }
}
</script>
</script>
