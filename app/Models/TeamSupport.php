<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamSupport extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

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
}
