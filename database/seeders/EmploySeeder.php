<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Employ;
use Illuminate\Database\Seeder;

class EmploySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dateNow = Carbon::now();
        
        $employs = ['Ketua II', 'Humas', 'Humas', 'Media', 'Sesi I', 'Sesi II'];
        $insert = [];
        foreach($employs as $index => $employ){
            $insert[$index]['name_employ'] = $employ; 
            $insert[$index]['created_at'] = $dateNow; 
            $insert[$index]['updated_at'] = $dateNow; 
        }
        
        Employ::query()->truncate();
        Employ::insert($insert);
        // Employ::create(['name_employ'=>'Ketua II'],['name_employ'=>'Humas'],['name_employ'=>'Humas'],['name_employ'=>'Media'],['name_employ'=>'Sesi I'],['name_employ'=>'Sesi II']);
    }
}
