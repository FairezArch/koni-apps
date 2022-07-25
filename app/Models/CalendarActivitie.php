<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\State;
use App\Models\Citie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;


class CalendarActivitie extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function countries()
    {
        # code...
        return $this->belongsTo(Countrie::class)->withDefault();
    }
    public function states()
    {
        # code...
        return $this->belongsTo(State::class)->withDefault();
    }
    public function cities()
    {
        # code...
        return $this->belongsTo(Citie::class)->withDefault();
    }
    public function sports()
    {
        # code...
        return $this->belongsTo(Sport::class)->withDefault();
    }

    public function scopeIndexPage(Builder $query)
    {
        # code...
        return $query->with('sports');
    }


    public function getState($countrie_id)
    {
        # code...
        return State::where('country_id', $countrie_id)->get();
    }

    public function getCitie($state_id)
    {
        # code...
        return Citie::where('state_id', $state_id)->get();
    }

    public function scopeFrontEndActivitie(Builder $query)
    {
        # code...
        return $query->orderBy('id', 'DESC')->take(4)->with('sports')->get();
    }

    public function scopeMenuActivitie(Builder $query, $sports_id, $list, $yearlist)
    {
        # code...
        $lists = $query->whereYear('created_at', '=', $yearlist);

        if ($sports_id !== 'all') {
            $lists->where('sports_id', $sports_id);
        } else {
            $lists->where('sports_id', 'like', '%%');
        }

        if ($list == 3) {
            $lists->where('date_from', '<=', Carbon::now()->format('Y-m-d'))->where('date_to', '>=', Carbon::now()->format('Y-m-d'));
        } else if ($list == 2) {
            $lists->where('date_from', '>=', Carbon::now()->format('Y-m-d'))->where('date_to', '>=', Carbon::now()->format('Y-m-d'));
        } else {
            $lists->where('sports_id', 'like', '%%');
        }

        $lists->orderBy('id', 'DESC')->with('sports')->get();

        return $lists;
    }

    public function scopeIndexPageMatch(Builder $query)
    {
        # code...
        return $query->orderBy('id', 'DESC')->take(5)->with('sports')->get();
    }

    // New

    public function scopeStoreData(Builder $query, $request)
    {
        # code...
        $media = new MediaModel();
        $folder = 'event';
        $section = 'insert';
        $filename = $media->addMedia($request->file_event, $folder, $section);

        $url = $request->address;
        $spliturl = explode('@', $url);
        $at = explode('z', $spliturl[1]);
        $zero = explode(',', $at[0]);
        $lat = (float)$zero[0];
        $long = (float)$zero[1];

        return $query->create([
            'match_name' => $request->name_match,
            'sports_id' => $request->sports_id,
            'date_from' => $request->date_from,
            'datetime_from' => $request->datetime_from,
            'date_to' => $request->date_to,
            'datetime_to' => $request->datetime_to,
            'file_event' => $filename,
            'address' => $request->address,
            'lat' => $lat,
            'long' => $long,
        ]);
    }

    public function scopeUpdateData(Builder $query, $request, $calendar)
    {
        # code...
        $media = new MediaModel();
        $section = 'update';
        $folder = 'event';
        $filename = $calendar->file_event;
        if ($request->hasFile('file_event')) {
            $filename = $media->addMedia($request->file_event, $folder, $section, $filename);
        }

        $url = $request->address;
        $spliturl = explode('@', $url);
        $at = explode('z', $spliturl[1]);
        $zero = explode(',', $at[0]);
        $lat = (float)$zero[0];
        $long = (float)$zero[1];

        return $calendar->update([
            'match_name' => $request->name_match,
            'sports_id' => $request->sports_id,
            'date_from' => $request->date_from,
            'datetime_from' => $request->datetime_from,
            'date_to' => $request->date_to,
            'datetime_to' => $request->datetime_to,
            'file_event' => $filename,
            'address' => $request->address,
            'lat' => $lat,
            'long' => $long,
        ]);
    }

    public function scopeDeleteData(Builder $query, $calendar)
    {
        # code...
        return $calendar->delete();
    }
}
