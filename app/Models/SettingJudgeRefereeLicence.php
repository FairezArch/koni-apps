<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingJudgeRefereeLicence extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'setting_judge_referee_licences';

    protected $fillable = [
        'licence_name'
    ];

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }
}
