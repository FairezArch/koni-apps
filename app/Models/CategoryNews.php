<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryNews extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=['category_name', 'slug', 'file_category'];

    public function news()
    {
        # code...
       return $this->hasMany(News::class);
    }
}
