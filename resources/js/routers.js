import Home from './components/dashboard/home.vue';
import about from './components/dashboard/about.vue';

// import component for Category
import Category from './components/dashboard/category/list.vue';
import addCategory from './components/dashboard/category/add.vue';
import editCategory from './components/dashboard/category/edit.vue';

// import component for sub_category
import subCategory from './components/dashboard/category/sub_category/list.vue';
import addSubCategory from './components/dashboard/category/sub_category/add.vue';
import editSubCategory from './components/dashboard/category/sub_category/edit.vue';

// import component for content
import content from './components/dashboard/content/list.vue';
import addContent from './components/dashboard/content/add.vue';
import editContent from './components/dashboard/content/edit.vue';


export const routes = [
    { path: '/', component: Home},
    { path: '/about', component: about },

    // Route for category
    { path: '/category', component: Category },
    { path: '/addCategory', component: addCategory },
    { path: '/editCategory/:categoryId', component: editCategory },

    // Route for sub_category
    { path: '/subCategory', component: subCategory },
    { path: '/addSubCategory', component: addSubCategory },
    { path: '/editSubCategory/:subCategoryId', component: editSubCategory },

    // Route for content
    { path: '/content', component: content },
    { path: '/addContent', component: addContent },
    { path: '/editContent/:contentId', component: editContent },
]
