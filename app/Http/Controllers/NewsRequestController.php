<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Sport;
use App\Models\MediaModel;
use Illuminate\Support\Str;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class  NewsRequestController extends Controller
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
                ->addColumn('created', function (News $news) {
                    return $this->attrFormat($news->user->name, Carbon::parse($news->showtime_from)->translatedFormat('d F Y'));
                })
                ->addColumn('showTime', function (News $news) {
                    return Carbon::parse($news->showtime_from)->translatedFormat('d F Y');
                })
                ->addColumn('action', function (News $news) {
                    return $news->id;
                })
                ->rawColumns(['category', 'created', 'showTime', 'action'])
                ->make(true);
        }

        return view('backend.pages.news.request.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sports = Sport::all();
        $categories = CategoryNews::all();
        return view('backend.pages.news.request.add', compact('sports', 'categories'));
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
    public function edit(News $tidings_request)
    {
        //
        $sports = Sport::all();
        $categories = CategoryNews::all();

        return view('backend.pages.news.request.edit', compact('tidings_request','sports', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $tidings_request)
    {
        //
        $update = News::UpdateData($request, $tidings_request);
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
    public function destroy(News $tidings_request)
    {
        //
        $del = News::DeleteData($tidings_request);
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
}
