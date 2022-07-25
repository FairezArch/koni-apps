<?php

namespace Database\Seeders;

use App\Models\CategoryNews;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = ['Popular','Train','Tech','Travel','Sain','Column','Hype','Regional'];
        $insert = [];
        $dateNow = Carbon::now();
        foreach($categories as $index => $category){
            $insert[$index]['category_name'] = $category; 
            $insert[$index]['created_at'] = $dateNow; 
            $insert[$index]['updated_at'] = $dateNow; 
        }
        CategoryNews::insert($insert);
    }
}
