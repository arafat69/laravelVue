<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category List</h3>
                <router-link to="/addCategory" class="btn btn-sm btn-primary float-right"> Add Category</router-link>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(categoryList,index) in getCategoryList" :key="categoryList.id">
                      <td>{{index+1}}</td>
                      <td>{{ categoryList.category }}</td>
                      <td>
                        <router-link :to="`/editCategory/${categoryList.id}`" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></router-link>
                        <a @click.prevent="categoryDelete(categoryList.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
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
    </section>
  </div>
</template>

<script>
export default {
    name: 'list',

    mounted() {
        this.$store.dispatch('getCategoryList')
    },

    computed: {
        getCategoryList(){
          return this.$store.getters.categoryList;
        }
    },
    methods: {
        categoryDelete(id){
            axios.get('/categoryDelete/'+id).then((Response)=>{
                this.$store.dispatch('getCategoryList')
                Toast.fire({
                    icon: 'success',
                    title: 'Category Delete successfully'
                })
            })
        }

    },

}
</script>
