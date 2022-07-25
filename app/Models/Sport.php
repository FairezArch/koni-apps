<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        # code...
        return $this->belongsTo(User::class)->withDefault();
    }

    public function atlets()
    {
        return $this->hasMany(Atlet::class, 'sports_id');
    }

    public function trainers()
    {
        return $this->hasMany(Trainner::class, 'sports_id');
    }

    public function referees()
    {
        return $this->hasMany(Referee::class, 'sports_id');
    }

    public function judges()
    {
        return $this->hasMany(Judge::class, 'sports_id');
    }

    public function clubs()
    {
        return $this->hasMany(Club::class, 'sports_id');
    }

    public function nomors()
    {
        return $this->hasMany(Nomor::class, 'sports_id');
    }

    public function gallery()
    {
        # code...
        return $this->hasMany(Gallery::class, 'sport_id');
    }

    public function teamSupports()
    {
        # code...
        return $this->hasOne(TeamSupport::class, 'sports_id')->withDefault();
    }

    public function scopeIndexPage(Builder $query)
    {
        # code...
        return $query->with(['clubs', 'nomors', 'atlets', 'trainers', 'referees', 'judges'])->get();
    }

    public function scopeSearchFirst(Builder $query, $slug)
    {
        # code...
        return $query->with('users')->where('slug', $slug)->first();
    }

    public function scopeFindData(Builder $query, $id)
    {
        # code...
        return $query->find($id);
    }

    public function scopeSearchById(Builder $query, $id)
    {
        # code...
        return $query->with(['clubs', 'nomors', 'atlets', 'trainers', 'referees', 'judges'])->find($id);
    }
}
