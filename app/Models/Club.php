<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'sports_id',
    //     'club_name',
    //     'users_id',
    //     'club_address',
    //     'club_phone',
    //     'email',
    //     'deed_of_company',
    //     'file_deed_of_company',
    //     'file_club',
    //     'status',
    // ];

    protected $guarded = [];

    public function users()
    {
        # code...
        return $this->belongsTo(User::class)->withDefault();
    }

    public function atlets()
    {
        return $this->hasMany(Atlet::class, 'clubs_id');
    }

    public function trainers()
    {
        return $this->hasMany(Trainner::class, 'clubs_id');
    }

    public function judges()
    {
        return $this->hasMany(Judge::class);
    }

    public function scopeCountData($query, $param, $value)
    {
        # code...
        return $query->where($param, $value)->get()->count();
    }

    public function scopeStoreData(Builder $query, $request, $sport_branch)
    {
        # code...
        $mediaModel = new MediaModel();
        $folder = 'club';
        $section = 'insert';

        $query->create([
            'sports_id' => $sport_branch->id,
            'club_name' => $request->club_name,
            'users_id' => $request->users_id,
            'club_address' => $request->club_address,
            'club_phone' => $request->club_phone,
            'email' => $request->email,
            'deed_of_company' => $request->deed_of_company,
            'file_deed_of_company' => $mediaModel->AddMedia($request->file_deed_of_company, $folder, $section),
            'file_club' => $mediaModel->AddMedia($request->file_club, $folder, $section),
            'desc' => $request->desc_club,
            'status' => $request->status
        ]);
    }

    public function scopeUpdateData(Builder $query, $request, $sport_branch, $club)
    {
        # code...
        $mediaModel = new MediaModel();
        $folder = 'club';
        $section = 'update';

        $filename = $club->file_deed_of_company;
        $filename1 = $club->file_club;

        if ($request->hasFile('file_deed_of_company')) {
            $filename = $mediaModel->AddMedia($request->file_deed_of_company, $folder, $section, $filename);
        }
        if ($request->hasFile('file_club')) {
            $filename1 = $mediaModel->AddMedia($request->file_club, $folder, $section, $filename1);
        }

        return $club->update([
            'sports_id' => $sport_branch->id,
            'club_name' => $request->club_name,
            'users_id' => $request->users_id,
            'club_address' => $request->club_address,
            'club_phone' => $request->club_phone,
            'email' => $request->email,
            'deed_of_company' => $request->deed_of_company,
            'file_deed_of_company' => $filename,
            'file_club' => $filename1,
            'desc' => $request->desc_club,
            'status' => $request->status
        ]);
    }

    public function scopeDeleteData(Builder $query, $sport_branch, $club)
    {
        # code...
        //
        $mediaModel = new MediaModel();
        $folder = 'club';

        if (!empty($club->file_deed_of_company)) {
            $mediaModel->deleteMedia($folder, $club->file_deed_of_company);
        }
        if (!empty($club->file_club)) {
            $mediaModel->deleteMedia($folder, $club->file_club);
        }

        return $club->delete();
    }

    // for profile club

    public function scopeUpdateDataProfileClub(Builder $query, $request, $club)
    {
        # code...
        $mediaModel = new MediaModel();
        $folder = 'club';
        $section = 'update';

        $filename = $club->file_deed_of_company;
        $filename1 = $club->file_club;

        if ($request->hasFile('file_deed_of_company')) {
            $filename = $mediaModel->AddMedia($request->file_deed_of_company, $folder, $section, $filename);
        }
        if ($request->hasFile('file_club')) {
            $filename1 = $mediaModel->AddMedia($request->file_club, $folder, $section, $filename1);
        }

        return $club->update([
            'sports_id' => $club->sport_id,
            'club_name' => $request->club_name,
            'users_id' => $request->users_id,
            'club_address' => $request->club_address,
            'club_phone' => $request->club_phone,
            'email' => $request->email,
            'deed_of_company' => $request->deed_of_company,
            'file_deed_of_company' => $filename,
            'file_club' => $filename1,
            'desc' => $request->desc_club,
            'status' => $request->status
        ]);
    }
}
