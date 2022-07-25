<?php

namespace Database\Seeders;

use Carbon\Carbon; 
use App\Models\Sport;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $sports = ['Esport'];
        // $insert = [];
        $dateNow = Carbon::now();
        
        Sport::query()->truncate();
        Sport::create([
            'sportbranch_name' => 'Esport',
            'slug' => Str::slug('Esport'),
            'users_id' => 4,
            'desc_sportbranch' => 'Komite Olahraga Nasional Indonesia (KONI) adalah satu-satunya organisasi yang berwenang dan bertanggung jawab mengelola',
            'organization' => 'Esport',
            'short_organization' => 'Esport',
            'created_at' => $dateNow,
            'updated_at' => $dateNow,
        ]);

        // foreach($sports as $index => $sport){
        //     $insert[$index]['sportbranch_name'] = $sport; 
        //     $insert[$index]['slug'] =  Str::slug($sport); 
        //     $insert[$index]['users_id'] =  4; 
        //     $insert[$index]['desc_sportbranch'] =  'Komite Olahraga Nasional Indonesia (KONI) adalah satu-satunya organisasi yang berwenang dan bertanggung jawab mengelola'; 
        //     $insert[$index]['organization'] =  $sport; 
        //     $insert[$index]['short_organization'] =  $sport; 
        //     $insert[$index]['created_at'] = $dateNow; 
        //     $insert[$index]['updated_at'] = $dateNow; 
        // }
        // Sport::insert($insert);

    }
}
