<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingJudgeReferee extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'certificate_name'
    ];

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }
}
