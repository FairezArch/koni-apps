<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Atlet extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function Tempvalue()
    {
        # code...
        return ['password' => 'atlet123123', 'roleID' => 6];
    }

    public function users()
    {
        # code...
        return $this->belongsTo(User::class)->withDefault();
    }

    public function sports()
    {
        return $this->belongsTo(Sport::class, 'sports_id')->withDefault();
    }

    public function nomors()
    {
        # code...
        return $this->belongsTo(Nomor::class)->withDefault();
    }

    public function clubs()
    {
        # code...
        return $this->belongsTo(Club::class)->withDefault();
    }

    public function scopeCountUserAtlet($query, $sport_id)
    {
        # code...
        return $query->where('sports_id', $sport_id)->get()->count();
    }

    public function scopeGroupCount($query, $param, $value, $grup)
    {
        # code...
        return $query->where($param, $value)->groupBy($grup)->get()->count();
    }

    public function scopeCountData($query, $param, $value)
    {
        # code...
        return $query->where($param, $value)->get()->count();
    }

    public function scopeIndexAtletNeedVerif(Builder $query)
    {
        # code...
        return $query->where('verify_atlet', 0)->with(['users', 'sports'])->get();
    }

    public function MessageInfo($data)
    {
        # code...
        switch ($data) {
            case 1:
                $msg = "Disetujui";
                break;
            case 2:
                $msg = "Ditolak";
                break;
            default:
                $msg = "Mohon dokumen dilengkapi";
        }

        return $msg;
    }

}
