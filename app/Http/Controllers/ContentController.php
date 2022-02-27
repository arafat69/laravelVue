<?php

namespace App\Http\Controllers;

use App\Models\content;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentList = content::with(['categories','sub_categories'])->get();
        return response()->json(['contentList'=>$contentList],200);
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
        $this->formValidation($request);

            $file_url = '';
        if ($request->file != '') {
            $uploadPath = public_path('uploads/');
            $fileName = $request->file->getClientOriginalName();
            $fileExtension = $request->file->getClientOriginalExtension();
            $newFileName = time().'.'.$fileExtension;
            $file_url = $newFileName;
            $request->file->move($uploadPath,$newFileName);
        }

        $content = new content();
        $content->category_id = $request->category_id;
        $content->subCategory_id = $request->subCategory_id;
        $content->title = $request->title;
        $content->description = $request->description;
        $content->file = $file_url;
        $content->video_url = $request->video_url;
        $content->save();

        return ['status',200];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(content $content,$id)
    {
        $contentById = content::find($id);
        return response()->json(['contentById'=>$contentById],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, content $content,$id)
    {
    $this->formValidation($request);

    $file_url = '';

    $content = content::find($id);

    if ($request->file != '') {
        $uploadPath = public_path('uploads/');
        $fileName = $request->file->getClientOriginalName();
        $fileExtension = $request->file->getClientOriginalExtension();
        $newFileName = time().'.'.$fileExtension;
        $file_url = $newFileName;
        $request->file->move($uploadPath,$newFileName);
        $content->file = $file_url;
    }

    $content->category_id = $request->category_id;
    $content->subCategory_id = $request->subCategory_id;
    $content->title = $request->title;
    $content->description = $request->description;
    $content->video_url = $request->video_url;
    $content->save();

    return ['status',200];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(content $content,$id)
    {
        $getFile = content::find($id);
        if ($getFile->file != '') {
            $path = public_path('uploads/').$getFile->file;
            unlink($path);
        }
        content::destroy($id);
        return ['status',200];
    }

    public function  getSubCategoryByCategoryId($id){

        $getSubCategoryList = subCategory::where('cat_id',$id)->get();
         return response()->json(['getSubCategoryList'=>$getSubCategoryList],200);
    }

    public function formValidation($request){
        $this->validate($request,[
            'category_id'=> 'required',
            'subCategory_id'=> 'required',
            'title'=> 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\content  $content
     * @return \Illuminate\Http\Response
     */
    public function categoryWishContent(){
        $categoryWishContent = DB::table('contents')
            ->join('categories','contents.category_id','=','categories.id')
            ->select('categories.category',DB::raw('count(contents.id) as total'))
            ->where('contents.deleted_at',NULL)
            ->groupBy('contents.category_id')
            ->get();
            return response()->json(['categoryWishContent'=>$categoryWishContent],200);
    }
}
