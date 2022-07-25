<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nomor_code',
        'date_from',
        'date_to',
        'sports_id',
        'nomors_id',
        'atlets_id',
        'achievement_level',
        'medal',
        'file_achievement',
        'status_achievement'
    ];
}
