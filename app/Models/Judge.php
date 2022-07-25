<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Judge extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function Tempvalue()
    {
        # code...
        return ['password' => 'judge123123', 'roleID' => 11];
    }

    public function sports()
    {
        # code...
        return $this->belongsTo(Sport::class)->withDefault();
    }

    public function users()
    {
        # code...
        return $this->belongsTo(User::class)->withDefault();
    }

    public function setting_judge_referees()
    {
        # code...
        return $this->belongsTo(SettingJudgeReferee::class)->withDefault();
    }

    public function setting_judge_referee_licences()
    {
        # code...
        return $this->belongsTo(SettingJudgeRefereeLicence::class)->withDefault();
    }

    public function nomor()
    {
        # code...
        return $this->belongsTo(Nomor::class)->withDefault();
    }

    public function club()
    {
        # code...
        return $this->belongsTo(Club::class)->withDefault();
    }

    public function scopecountUserJudge($query, $sport_id)
    {
        # code...
        return $query->where('sports_id', $sport_id)->get()->count();
    }

    public function findJudgeUsers(Builder $query, $id)
    {
        # code...
        return $query->with('users')->findOrFail($id);
    }
}
