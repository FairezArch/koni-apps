<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use DB;

class SettingLandingPage extends Model
{
    use HasFactory;

    public function getDataUsersAttribute($value)
    {
        # code...
        return $value == null ? json_encode([]) : $value;

    }

    protected $fillable = [
        'about_koni',
        'profile_koni',
        'data_users'
    ];

    public function scopeListsUser()
    {
        # code...
        $selectRole = 1;
        return User::join('model_has_roles','users.id','model_has_roles.model_id')
                    ->leftjoin('employs','users.position','employs.id')
                    ->select('users.id','users.name','users.position','users.photo','employs.name_employ')
                    ->where('model_id','!=',$selectRole)
                    ->where('model_id','!=',3)
                    ->get();
    }
}
