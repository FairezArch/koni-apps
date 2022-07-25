<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryVerifyAtlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_result',
        'atlets_id',
        'conclusion_status'
    ];
}
