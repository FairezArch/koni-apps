<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'sports_id',
        'domicile',
        'nik_referees',
        'file_ktp_referee',
        'npwp_referee',
        'file_npwp_referee',
        'setting_judge_referees_id',
        'setting_judge_referee_licences_id',
        'certificate_number',
        'exp_certificate',
        'file_certificate_referee',
    ];

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

    public function scopeCountUserReferee(Builder $query, $sport_id)
    {
        # code...
        return $query->where('sports_id', $sport_id)->get()->count();
    }

    public function scopeIndexPage(Builder $query)
    {
        # code...
        return $query->with(['sports', 'users', 'setting_judge_referees', 'setting_judge_referee_licences'])->get();
    }

    public function scopefindRefereeUsers(Builder $query, $id)
    {
        # code...
        return $query->with('users')->find($id);
    }
}
