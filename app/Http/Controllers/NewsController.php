<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Sport;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    public function attrFormat($someFirst, $someSecond)
    {
        return $someFirst . '|###|' . $someSecond;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $categories = CategoryNews::all();
        if ($request->ajax()) {
            $data = News::Data($request);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function (News $news) {
                    return $news->categories->category_name;
                })
                ->addColumn('created', function ($row) {
                    return $this->attrFormat($row->user->name, Carbon::parse($row->showtime_from)->translatedFormat('d F Y'));
                })
                ->addColumn('showTime', function ($row) {
                    return Carbon::parse($row->showtime_from)->translatedFormat('d F Y');
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['category', 'created', 'showTime', 'action'])
                ->make(true);
        }

        return view('backend.pages.news.index-news', compact('categories'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($option)
    {
        //
        $sports = Sport::all();
        $categories = CategoryNews::all();
        return view('backend.pages.news.add-news', compact('option', 'sports', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        //
        // 
        $save = News::StoreData($request);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "News created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "News created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $tidings, $option)
    {
        //
        $sports = Sport::all();
        $categories = CategoryNews::all();

        return view('backend.pages.news.edit-news', compact('option', 'sports', 'categories', 'tidings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $id)
    {
        //
        $update = News::findOrFail($id);
        $update->UpdateData($request, $update);

        if ($update) {
            $data = [
                'success' => true,
                'messages' => "News updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "News updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $del = News::findOrFail($id);
        $del->DeleteData($del);

        if ($del) {
            $data = [
                'success' => true,
                'messages' => "News deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "News deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    public function countData($option)
    {
        # code...
        $count = News::where(['type_news', $option], ['status', '!=', 2])->get();
        if ($count) {
            $data = [
                'success' => true,
                'messages' => "Get list request news",
                'value' => $count->count()
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Something error",
                'value' => ''
            ];
        }

        return response()->json($data);
    }
}
