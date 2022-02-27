<?php

namespace App\Http\Controllers;

use App\Models\subCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategoryList = subCategory::with('categories')->get();
        return response()->json(['subCategoryList'=>$subCategoryList],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subCategory_info = new subCategory();
        $subCategory_info->cat_id= $request->cat_id;
        $subCategory_info->sub_cat = $request->sub_cat;
        $subCategory_info->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(subCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(subCategory $subCategory,$id)
    {
        $subCategoryById = subCategory::find($id);
        return response()->json(['subCategoryById'=>$subCategoryById],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subCategory $subCategory,$id)
    {
        $subCat_info = subCategory::find($id);
        $subCat_info->cat_id = $request->cat_id;
        $subCat_info->sub_cat = $request->sub_cat;
        $subCat_info->save();

        return ['status'=>'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(subCategory $subCategory,$id)
    {
        subCategory::destroy($id);
        return ['status'=>'sucess'];
    }
}
