<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Content List</h3>
                <router-link to="/addContent" class="btn btn btn-success float-right"> Add Content</router-link>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Category Name</th>
                      <th>subCategory Name</th>
                      <th>Content Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(contentList,index) in getContentList" :key="contentList.id">
                      <td>{{index+1}}</td>
                      <td>{{ contentList.categories.category }}</td>
                       <td>{{ contentList.sub_categories.sub_cat }}</td>
                       <td>{{ contentList.title }}</td>
                      <td>
                        <router-link :to="`/editContent/${contentList.id}`" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></router-link>
                        <a @click.prevent="contentDelete(contentList.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
        this.$store.dispatch('getContentList');
    },

    computed: {
        getContentList(){
            return this.$store.getters.contentList
        }

    },
    methods: {
        contentDelete(id){
            axios.get('/contentDelete/'+id).then((Response)=>{
                this.$store.dispatch('getContentList')
                Toast.fire({
                    icon: 'success',
                    title: 'Content Delete successfully'
                })
            });
        }

    },

}
</script>
