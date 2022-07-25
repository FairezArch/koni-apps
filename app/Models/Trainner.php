<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainner extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function Tempvalue()
    {
        # code...
        return ['password' => 'trainer123123', 'roleID' => 9];
    }

    public function users()
    {
        # code...
        return $this->belongsTo(User::class)->withDefault();
    }

    public function sports()
    {
        # code...
        return $this->belongsTo(Sport::class)->withDefault();
    }

    public function clubs()
    {
        # code...
        return $this->belongsTo(Club::class, 'clubs_id')->withDefault();
    }

    public function certificate_professions()
    {
        # code...
        return $this->belongsTo(CertificateProfession::class)->withDefault();
    }

    public function status_trainners()
    {
        # code...
        return $this->belongsTo(StatusTrainner::class)->withDefault();
    }

    public function nomor()
    {
        # code...
        return $this->belongsTo(Nomor::class)->withDefault();
    }

    public function scopeCountUserTrainner(Builder $query, $sport_id)
    {
        # code...
        return $query->where('sports_id', $sport_id)->get()->count();
    }

    public function scopeGroupCount(Builder $query, $param, $value, $grup)
    {
        # code...
        return $query->where($param, $value)->groupBy($grup)->get()->count();
    }

    public function scopeCountData(Builder $query, $param, $value)
    {
        # code...
        return $query->where($param, $value)->get()->count();
    }

    public function scopeIndexPageCertain(Builder $query, $sport_id, $club_id)
    {
        # code...
        return $query->where('sports_id', $sport_id)->where('clubs_id', $club_id)->with(['sports', 'users', 'certificate_professions', 'status_trainners', 'nomor'])->get();
    }
}
