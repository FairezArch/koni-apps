<?php

namespace App\Http\Controllers;

use App\Models\MediaModel;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreCategoryNewsRequest;
use App\Http\Requests\UpdateCategoryNewsRequest;
class CategoryNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = CategoryNews::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('file_category', function ($row) {
                    $url = asset("storage/categorynews/".$row->file_category); 
                    return '<img src=\''.$url.'\' alt="'.$row->file_category.'" border="0" width="40" class="img-rounded img-thumbnail" align="center" />'; 
                })
                ->addColumn('category_name', function ($row) {
                   
                    return $row->category_name;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['file_category', 'category_name', 'action'])
                ->make(true);
        }

        return view('backend.pages.news.category.news-index-category');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('backend.pages.news.category.news-add-category');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryNewsRequest $request)
    {
        //
        $media = new MediaModel();
        $folder = 'categorynews';
        $section = 'insert';
        $save = CategoryNews::create([
            'category_name' => $request->category_name,
            'file_category' => $media->AddMedia($request->file_category, $folder, $section)
        ]);

        if($save){
            $data = [
                'success' => true,
                'messages' => "Category News created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Category News created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryNews $categoryNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryNews $categoryNews, $id)
    {
        //
        $lists = CategoryNews::find($id);

        return view('backend.pages.news.category.news-edit-category', compact('lists'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryNewsRequest  $request
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryNewsRequest $request, CategoryNews $categoryNews, $id)
    {
        //
        $media = new MediaModel();
        $folder = 'categorynews';
        $section = 'update';

        $update = CategoryNews::find($id);
        $filename = $update->file_category;
        if($request->hasFile('file_category')){ $filename = $media->AddMedia($request->file_category, $folder, $section, $filename); }
        $update->update([
            'category_name' => $request->category_name,
            'file_category' => $filename
        ]);

        if($update){
            $data = [
                'success' => true,
                'messages' => "Category News updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Category News updated unsuccessfully"
            ];

        }
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryNews $categoryNews, $id)
    {
        //
        $delete = $categoryNews::find($id);
        $delete->delete();
        if($delete){
            $data = [
                'success' => true,
                'messages' => "Category News deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Category News deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}
