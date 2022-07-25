<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::create([
            'address' => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi dolorum autem amet corporis adipisci dicta beatae non commodi possimus, maiores repellat blanditiis accusamus magni minima recusandae iure tempora, ducimus accusantium.",
            'email' => "koni@example.net",
            'whatsapp' => "+628877349392",
            'instagram' => "https://www.instagram.com/",
            'facebook' => "https://www.facebook.com/"
        ]);
    }
}
