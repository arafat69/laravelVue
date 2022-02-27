<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Sub Category</h3>
              </div>
              <form @submit.prevent="subCategoryUpdate">
                <div class="card-body">
                  <div class="form-group">
                    <label class="m-0">Select Category</label>
                    <select v-model="form.cat_id" name="cat_id" class="form-control form-control-sm" >
                        <option :value="category.id" v-for="category in getCategoryList" :key="category.id">
                            {{category.category}}
                        </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="m-0">Sub Category Name</label>
                    <input type="text" v-model="form.sub_cat" class="form-control form-control-sm" placeholder="Enter Sub Category Name" name="sub_cat">
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
        cat_id: '',
        sub_cat: '',
      })
  }),

 mounted() {
        this.$store.dispatch('getCategoryList')
    },
     created() {
      axios.get('/subCategoryById/'+this.$route.params.subCategoryId).then((Response)=>{
          this.form.fill(Response.data.subCategoryById)
      })
  },

    computed: {
        getCategoryList(){
          return this.$store.getters.categoryList;
        }
    },
  methods: {
    subCategoryUpdate () {
      // Submit the form via a POST request
      this.form.post(`/subCategoryUpdate/${this.$route.params.subCategoryId}`)
       .then((response) => {
         this.$router.push('/subCategory');
         Toast.fire({
            icon: 'success',
            title: 'Sub Category Update successfully'
            })
        })
    },
     goBack(){
            this.$router.push('/subCategory');
        },

  }
}
</script>
</script>
