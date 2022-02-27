<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Content</h3>
              </div>
              <form @submit.prevent="contentSave" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 border-right">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="m-0">Select Category</label>
                                        <select @change="getSubCategory" v-model="category_id" name="category_id" class="form-control form-control-sm" >
                                            <option :value="category.id" v-for="category in getCategoryList" :key="category.id">
                                                {{category.category}}
                                            </option>
                                        </select>
                                        <div class="text-danger" v-if="errors && errors.category_id">{{errors.category_id[0]}}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="m-0">Select  SubCategory</label>
                                        <select v-model="subCategory_id" name="subCategory_id" class="form-control form-control-sm" >
                                            <option :value="sub_cat.id" v-for="sub_cat in subCategory" :key="sub_cat.id">
                                                {{sub_cat.sub_cat}}
                                            </option>
                                        </select>
                                        <div class="text-danger" v-if="errors && errors.subCategory_id">{{errors.subCategory_id[0]}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="m-0">Content Title</label>
                                        <input type="text" v-model="title" class="form-control form-control-sm" placeholder="Enter Title" name="title">
                                        <div class="text-danger" v-if="errors && errors.title">{{errors.title[0]}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="form-group">
                                        <label for="exampleInputEmail1" class="m-0">Description</label>
                                        <ckeditor :editor="editor" v-model="description" name="description" :config="editorConfig"></ckeditor>
                                        <div class="text-danger" v-if="errors && errors.description">{{errors.description[0]}}</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="m-0">Upload File</label>
                                <input type="file"  class="form-control" name="file" @change="getFile">
                                <div class="text-danger" v-if="errors && errors.description">{{errors.description}}</div>
                            </div>
                            <div class="form-group">
                                <label for="" class="m-0">Video Url</label>
                                <input type="text" v-model="video_url" class="form-control" placeholder="Enter URL" name="video_url">
                                <div class="text-danger" v-if="errors && errors.video_url">{{errors.video_url}}</div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <button @click="goBack()" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>
                        </div>
                    </div>
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    name: 'save',
  data: () => ({

    subCategory:[],
    category_id:'',
    subCategory_id:'',
    title:'',
    description:'',
    file:'',
    video_url:'',
    errors:{},


    editor: ClassicEditor,
    editorData: '<p>Content of the editor.</p>',
    editorConfig: {
        // The configuration of the editor.
    },

  }),
 mounted() {
        this.$store.dispatch('getCategoryList')
    },

    computed: {
        getCategoryList(){
          return this.$store.getters.categoryList;
        }
    },
  methods: {

      getFile(e){
        this.file = e.target.files[0];
      },

    getSubCategory(){
    axios.get('/getSubCategoryByCategoryId/'+this.category_id).then((response)=>{
        this.subCategory = response.data.getSubCategoryList;
    })
    },

    contentSave () {
      // Submit the form via a POST request
      let form = new FormData;
      form.append('category_id',this.category_id);
      form.append('subCategory_id',this.subCategory_id);
      form.append('title',this.title);
      form.append('description',this.description);
      form.append('file',this.file);
      form.append('video_url',this.video_url);

      axios.post('/contentSave',form).then(({ data }) => {
         this.$router.push('/content');
         Toast.fire({
            icon: 'success',
            title: 'Content Added successfully'
            })
        }).catch(error=>{
            this.errors = error.response.data.errors;
        });
    },
     goBack(){
            this.$router.push('/content');
        },

  }
}
</script>
<style>
.border-right{
    border-right: 1px solid #b1b6bb!important;
}
</style>
