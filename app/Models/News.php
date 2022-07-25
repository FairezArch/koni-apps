<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\NewsHashtag;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'users_id')->withDefault();;
    }

    public function categories()
    {
        # code...
        return $this->belongsTo(CategoryNews::class, 'category_news_id')->withDefault();
    }

    public function sports()
    {
        # code...
        return $this->belongsTo(Sport::class, 'sports_id')->withDefault();
    }

    public function getFileNewsAttribute($value)
    {
        # code...
        return $value == null ? json_encode([]) : $value;
    }

    public function getHashtagsAttribute($value)
    {
        # code...
        return $value == null ? json_encode([]) : $value;
    }

    public function scopeData(Builder $query, $request)
    {
        # code...
        $res = $query->with(['categories', 'user'])
            ->where(function (Builder $query) use ($request) {

                (empty($request->dateFrom)) ? $query->where('showtime_from', '>=', Carbon::now()->format('Y-m-d')) : $query->where('showtime_from', '>=', Carbon::parse($request->dateFrom)->translatedFormat('Y-m-d'));
            })
            ->where(function (Builder $query) use ($request) {

                (empty($request->dateTo)) ? $query->where('showtime_from', '<=', Carbon::now()->format('Y-m-d')) : $query->where('showtime_from', '<=', Carbon::parse($request->dateTo)->translatedFormat('Y-m-d'));
            })
            ->where(function (Builder $query) use ($request) {

                ($request->categoryNews === 'all') ? $query->where('category_news_id', 'LIKE', '%%') : $query->where('category_news_id', $request->categoryNews);
            })->where(function (Builder $query) use ($request) {

                if (empty($request->select)) {
                    $query->where('type_news', 'LIKE', '%%');
                } else if ($request->select == 4) {
                    $query->where('type_news', $request->select)->where('status', '!=', 2);
                } else {
                    $query->where('type_news', $request->select);
                }
            });

        if (Auth::user()->sports->id) {
            $res->where('sports_id', Auth::user()->sports->id);
        } else if (Auth::user()->team_support->sports_id) {
            $res->where('sports_id', Auth::user()->team_support->sports_id);
        }

        $res->orderBy('showtime_from', 'DESC');

        return $res;
    }

    public function scopeStoreData(Builder $query, $request)
    {
        # code...
        $media = new MediaModel();
        $typeNews = $request->status_news == 1 ? 1 : $request->type_news;
        $setFilename = null;

        $arr_hashtag = [];
        if (!empty($request->hashtags)) {
            $exp = explode(',', $request->hashtags);
            $count = count($exp) - 1;
            for ($i = 0; $i <= $count; $i++) {
                $arr_hashtag[] = $exp[$i];
            }
        }

        if ($request->TotalImages > 0) {
            $folder = 'news';
            $section = 'insert';

            for ($x = 0; $x < $request->TotalImages; $x++) {
                if ($request->hasFile('file_news' . $x)) {
                    $filename = $media->addMedia($request->file('file_news' . $x), $folder, $section);
                    $data[$x] = $filename;
                }
            }
            $setFilename = json_encode($data);
        }

        $news = $query->create([
            'type_news' => $typeNews,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_content' => $request->short_content,
            'content' => $request->content_news,
            'file_news' => $setFilename,
            'hashtags' => json_encode($arr_hashtag),
            'showtime_from' => $request->date_from_news,
            'sports_id' => $request->sports_id,
            'category_news_id' => $request->category_news_id,
            'status' => $typeNews == 1 ? 1 : $request->status_news,
            'reason' => $request->reason,
            'users_id' => Auth::user()->id,
        ]);

        $time = Carbon::now();

        /** Need to improve or change the stream hashtags, due to double looping to set news id used to enter data into "NewsHashtags" */
        $inputHashtags = [];
        if (!empty($request->hashtags)) {
            $exp = explode(',', $request->hashtags);
            $count = count($exp) - 1;
            for ($i = 0; $i <= $count; $i++) {
                $inputHashtags[$i]['news_id'] = $news->id;
                $inputHashtags[$i]['hashtags'] = $exp[$i];
                $inputHashtags[$i]['created_at'] = $time;
                $inputHashtags[$i]['updated_at'] = $time;

                $arr_hashtag[] = $exp[$i];
            }
            NewsHashtag::insert($inputHashtags);
        }

        return $news;
    }

    public function scopeUpdateData(Builder $query, $request, $news)
    {
        # code...
        $media = new MediaModel();
        $typeNews = $request->status_news == 1 ? 1 : $request->type_news;

        $setFilename = $news->file_news;

        if ($request->TotalImages > 0) {

            $folder = 'news';
            $section = 'insert';

            if (!empty($setFilename)) {
                $files = json_decode($setFilename);
                foreach ($files as $file) {
                    $media->deleteMedia($folder, $file);
                }
            }

            for ($x = 0; $x < $request->TotalImages; $x++) {
                if ($request->hasFile('file_news' . $x)) {
                    $filename = $media->addMedia($request->file('file_news' . $x), $folder, $section);
                    $data[$x] = $filename;
                }
            }

            $setFilename = json_encode($data);
        }

        $arr_hashtags = [];
        $inputHashtags = [];
        $time = Carbon::now();

        if (!empty($request->hashtags)) {
            $exp = explode(',', $request->hashtags);
            $count = count($exp) - 1;
            for ($i = 0; $i <= $count; $i++) {
                $inputHashtags[$i]['news_id'] = $news->id;
                $inputHashtags[$i]['hashtags'] = $exp[$i];
                $inputHashtags[$i]['created_at'] = $time;
                $inputHashtags[$i]['updated_at'] = $time;

                $arr_hashtags[] = $exp[$i];
            }
            NewsHashtag::insert($inputHashtags);
        }

        $setMerge = array_merge(json_decode($news->hashtags), $arr_hashtags);

        return $news->update([
            'type_news' => $typeNews,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_content' => $request->short_content,
            'content' => $request->content_news,
            'file_news' => $setFilename,
            'hashtags' => json_encode($setMerge),
            'showtime_from' => $request->date_from_news,
            'sports_id' => $request->sports_id,
            'category_news_id' => $request->category_news_id,
            'status' => $typeNews == 1 ? 1 : $request->status_news,
            'reason' => $request->reason,
            'users_id' => Auth::user()->id,
        ]);
    }

    public function scopeDeleteData(Builder $query, $news)
    {
        # code...
        $media = new MediaModel();
        $folder = 'news';

        NewsHashtag::where('news_id', $news->id)->delete();

        if (!empty($news->file_news)) {
            $files = json_decode($news->file_news);
            foreach ($files as $file) {
                $media->deleteMedia($folder, $file);
            }
        }

        return $news->delete();
    }

    public function scopeGroupNews(Builder $query)
    {
        # code...
        return $query->with('categories')->where('type_news', 1)->get();
    }

    public function scopeDetailNews(Builder $query, $slug)
    {
        # code...
        return $query->with('categories')->where('slug', $slug)->first();
    }

    public function scopeListNews(Builder $query, $cat_news, $selectNews, $news_id)
    {
        # code...
        if ($selectNews == 1) {
            return $query->with(['categories', 'user'])->where(['category_news_id', $cat_news], ['id', '!=', $news_id], ['type_news', 1])->take(5)->latest('id')->get();
        } else {
            return $query->with(['categories', 'user'])->where(['id', '!=', $news_id], ['type_news', 1])->take(5)->latest('id')->get();
        }
    }
}
