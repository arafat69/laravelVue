<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sub Category List</h3>
                <router-link to="/addSubCategory" class="btn btn-sm btn-primary float-right"> Add Sub Category</router-link>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Category Name</th>
                      <th>subCategory Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(subCategoryList,index) in getSubCategoryList" :key="subCategoryList.id">
                      <td>{{index+1}}</td>
                      <td>{{ subCategoryList.categories.category }}</td>
                       <td>{{ subCategoryList.sub_cat }}</td>
                      <td>
                        <router-link :to="`/editSubCategory/${subCategoryList.id}`" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></router-link>
                        <a @click.prevent="subCategoryDelete(subCategoryList.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
        this.$store.dispatch('getCategoryList');
        this.$store.dispatch('getSubCategoryList')
    },

    computed: {
        getCategoryList(){
          return this.$store.getters.categoryList;
        },
        getSubCategoryList(){
            return this.$store.getters.subCategoryList
        }

    },
    methods: {
        subCategoryDelete(id){
            axios.get('/subCategoryDelete/'+id).then((Response)=>{
                this.$store.dispatch('getSubCategoryList')
                Toast.fire({
                    icon: 'success',
                    title: 'Category Delete successfully'
                })
            })
        }

    },

}
</script>
