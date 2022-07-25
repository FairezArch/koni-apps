<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\CategoryNews;
use App\Models\NewsHashtag;

class FrontNewsController extends Controller
{
    //
    public function index()
    {
        # code...
        $category = CategoryNews::whereHas('news', function ($query) {
            $query->where('type_news', 1);
        })->get();
        $topNews = News::where('type_news', 1)->latest('id')->first();
        !empty($topNews) ? $news = News::where([['type_news', 1], ['id', '!=', $topNews->id]])->latest('id')->take('3')->get() : $news = null;

        return view('frontend.pages.news.news', compact('category', 'news', 'topNews'));
    }

    public function detail($slug)
    {
        # code...
        $lists = News::DetailNews($slug);
        $newsByCategories = News::ListNews($lists->category_news_id, 1, $lists->id);
        $new_news = News::ListNews($lists->category_news_id, 2, $lists->id);
        
        return view('frontend.pages.news.newsDetails', compact('lists', 'newsByCategories', 'new_news'));
    }

    public function hashtags($slug)
    {
        # code...
        $topNews = null;
        $news = null;

        if (NewsHashtag::where('hashtags', $slug)->exists()) {
            $ids = [];
            $slugs = NewsHashtag::where('hashtags', $slug)->get();
            foreach ($slugs as $slug) {
                $ids[] = $slug->news_id;
            }
            $topNews = News::whereIn('id', $ids)->where('type_news', 1)->latest('id')->first();
            $news = News::whereIn('id', $ids)->where([['id','!=',$topNews->id], ['type_news', 1]])->latest('id')->get();
        }

        return view('frontend.pages.news.newHashtags', compact('topNews', 'news', 'slug'));
    }
    
    public function detailCategory($slug)
    {
        # code...
        
        $topNews = null;
        $news = null;
        $category = CategoryNews::where('slug', $slug)->first();
     
        if(!empty($category)){
            $topNews = News::where('category_news_id', $category->id)->where('type_news', 1)->latest('id')->first();
            $news = News::where([ ['category_news_id', $category->id],['id','!=',$topNews->id], ['type_news', 1] ])->latest('id')->get();
        }
        
        return view('frontend.pages.news.newsDetailCategory', compact('topNews', 'news', 'slug'));
    }
}
