<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo',
        'place_born',
        'date_of_birth',
        'gender',
        'address',
        'sk_number',
        'sk_file',
        'sk_date_from',
        'sk_date_to',
        'position',
        'status',
        'phone_number',
        'email',
        'password',
    ];

    public function news()
    {
    	return $this->belongsTo(News::class)->withDefault();
    }

    public function atlets()
    {
        return $this->hasOne(Atlet::class, 'users_id')->withDefault();
    }

    public function sports()
    {
        return $this->hasOne(Sport::class, 'users_id')->withDefault();
    }

    public function team_support()
    {
        return $this->hasOne(TeamSupport::class, 'users_id')->withDefault();
    }

    public function referees()
    {
        return $this->hasOne(Referee::class, 'users_id')->withDefault();
    }

    public function clubs()
    {
        return $this->hasOne(Club::class, 'users_id')->withDefault();
    }

    public function trainer()
    {
        return $this->hasOne(Trainner::class, 'users_id')->withDefault();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeRoleUser(Builder $query)
    {
        # code...
        return $query->leftjoin('model_has_roles','users.id','model_has_roles.model_id')
                ->join('roles','model_has_roles.role_id','roles.id')
                ->select('users.id', 'users.name','users.photo','users.sk_number','users.sk_date_to','users.email','users.phone_number', 'users.sk_date_from','roles.name as roleName', 'users.status')
                ->where('model_has_roles.role_id','!=',3)
                ->where('model_has_roles.role_id','!=',1)
                ->get();
    }
}