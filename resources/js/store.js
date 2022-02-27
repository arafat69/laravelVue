import Axios from "axios"

export default{
    state:{
        category: [],
        subCategory: [],
        content: [],
    },

    getters:{
        categoryList(state){
            return state.category;
        },
        subCategoryList(state){
            return state.subCategory;
        },
        contentList(state){
            return state.content;
        }
    },

    actions:{
        getCategoryList(context){
            Axios.get('/categoryList').then((response) => {
                context.commit('categoryList',response.data.categoryList);
            })
        },
        getSubCategoryList(context){
            Axios.get('/subCategoryList').then((response)=>{
                context.commit('subCategoryList',response.data.subCategoryList);
            })
        },
        getContentList(context){
            Axios.get('/contentList').then((response)=>{
                context.commit('contentList',response.data.contentList);
            })
        }
    },
    mutations:{
        categoryList(state,responseData){
            return state.category = responseData;
        },
        subCategoryList(state,responseData){
            return state.subCategory = responseData;
        },
        contentList(state,responseData){
            return state.content = responseData;
        }

    }

}
