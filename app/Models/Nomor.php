<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function atlets()
    {
        # code...
        $this->hasMany(Atlet::class, 'nomors_id');
    }

    public function trainers()
    {
        # code...
        $this->hasMany(Trainner::class, 'nomors_id');
    }

    public function scopeCountData($query,$param,$value)
    {
        # code...
        return $query->where($param,$value)->get()->count();
    }

    public function scopeStoreData(Builder $query, $request, $sport_branch)
    {
        # code...
        return $query->create([
            'sports_id' => $sport_branch->id,
            'nomor_code' => $request->nomor_code,
            'status' => $request->status
        ]);
    }

    public function scopeUpdateData(Builder $query, $request, $sport_branch, $nomor)
    {
        # code...
        return $nomor->update([
            'sports_id' => $sport_branch->id,
            'nomor_code' => $request->nomor_code,
            'status' => $request->status
        ]);
    }

    public function scopeDeleteData(Builder $query, $sport_branch, $nomor)
    {
        # code...
        return $nomor->delete();
    }
}
