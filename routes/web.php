<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route for save Category
Route::post('/categorySave', [CategoryController::class, 'store'])->name('category.store');
// Route for get Category List
Route::get('/categoryList', [CategoryController::class, 'index'])->name('category.index');
// Route for edit Category
Route::get('/categoryById/{id}', [CategoryController::class, 'edit'])->name('category.edit');
// Route for Update Category
Route::post('/categoryUpdate/{id}', [CategoryController::class, 'update'])->name('category.update');
// Route for delete Category
Route::get('/categoryDelete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

// Route for Save subCategory
Route::post('/subCategorySave', [SubCategoryController::class, 'store'])->name('subCategory.store');
// Route for get subCategory List
Route::get('/subCategoryList', [SubCategoryController::class, 'index'])->name('subCategory.index');
// Route for edit Sub Category
Route::get('/subCategoryById/{id}', [SubCategoryController::class, 'edit'])->name('subCategory.edit');
// Route for Update Sub Category
Route::post('/subCategoryUpdate/{id}', [SubCategoryController::class, 'update'])->name('subCategory.update');
// Route for Delete Sub Category
Route::get('/subCategoryDelete/{id}', [SubCategoryController::class, 'destroy'])->name('subCategory.destroy');

// Route for get subCategory By CategoryId
Route::get('/getSubCategoryByCategoryId/{id}', [ContentController::class, 'getSubCategoryByCategoryId'])->name('content.getSubCategoryByCategoryId');
// Route for Save content
Route::post('/contentSave', [ContentController::class, 'store'])->name('content.store');
// Route for get content List
Route::get('/contentList', [ContentController::class, 'index'])->name('content.index');
// Route for edit content
Route::get('/contentById/{id}', [ContentController::class, 'edit'])->name('content.edit');
// Route for edit content
Route::post('/contentUpdate/{id}', [ContentController::class, 'update'])->name('content.update');
// Route for Delete content
Route::get('/contentDelete/{id}', [ContentController::class, 'destroy'])->name('content.destroy');


//Dashboard Charts
// Route for category wish content
Route::get('/categoryWishContent',[ContentController::class, 'categoryWishContent'])->name('content.categoryWishContent');
