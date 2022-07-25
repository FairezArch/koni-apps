<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::query()->truncate();
        $admin = User::create([
            'name' => 'Drs H. Nurhasan, M.Pdd',
            'photo' => 'apple-icon_1640267953.png',
            'place_born' => 'Semarang',
            'date_of_birth' => '2021-12-22',
            'gender' => 1,
            'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
            'sk_number' => 'SK II /132.343.34235/Atlet/4234',
            'sk_file' => 'apple-icon_1640267953.png',
            'sk_date_from' => '2021-12-22',
            'sk_date_to' => '2021-12-31',
            'position' => 2,
            'status' => 1,
            'phone_number' => '(021) 5737494',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('sp123123')
        ]);

        $admin->assignRole('superadmin');
        
        $admin2 = User::create([
            'name' => 'Amaranda Rama',
            'photo' => 'apple-icon_1640267953.png',
            'place_born' => 'Semarang',
            'date_of_birth' => '2021-12-22',
            'gender' => 1,
            'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
            'sk_number' => 'SK II /132.343.34235/Atlet/4234',
            'sk_file' => 'apple-icon_1640267953.png',
            'sk_date_from' => '2021-12-22',
            'sk_date_to' => '2021-12-31',
            'position' => 2,
            'status' => 1,
            'phone_number' => '(021) 5737494',
            'email' => 'konipusat@gmail.com',
            'password' => Hash::make('koni123123')
        ]);
        $admin2->assignRole('koni');

        $admin3 = User::create([
            'name' => 'Salih Salim',
            'photo' => 'apple-icon_1640267953.png',
            'place_born' => 'Semarang',
            'date_of_birth' => '2021-12-22',
            'gender' => 1,
            'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
            'sk_number' => 'SK II /132.343.34235/Atlet/4234',
            'sk_file' => 'apple-icon_1640267953.png',
            'sk_date_from' => '2021-12-22',
            'sk_date_to' => '2021-12-31',
            'position' => 2,
            'status' => 1,
            'phone_number' => '(021) 5737494',
            'email' => 'adminutama@gmail.com',
            'password' => Hash::make('au123123')
        ]);
        $admin3->assignRole('adminutama');

        $a = User::create([
            'name' => 'Budi Anduk',
            'photo' => 'apple-icon_1640267953.png',
            'place_born' => 'Semarang',
            'date_of_birth' => '2021-12-22',
            'gender' => 1,
            'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
            'sk_number' => 'SK II /132.343.34235/Atlet/4234',
            'sk_file' => 'apple-icon_1640267953.png',
            'sk_date_from' => '2021-12-22',
            'sk_date_to' => '2021-12-31',
            'position' => 2,
            'status' => 1,
            'phone_number' => '(021) 5737494',
            'email' => 'budianduk@gmail.com',
            'password' => Hash::make('123123')
        ]);
        $a->assignRole('cabor');

        // $a2 = User::create([
        //     'name' => 'Nasmara Faur',
        //     'photo' => 'apple-icon_1640267953.png',
        //     'place_born' => 'Semarang',
        //     'date_of_birth' => '2021-12-22',
        //     'gender' => 1,
        //     'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
        //     'sk_number' => 'SK II /132.343.34235/Atlet/4234',
        //     'sk_file' => 'apple-icon_1640267953.png',
        //     'sk_date_from' => '2021-12-22',
        //     'sk_date_to' => '2021-12-31',
        //     'position' => 2,
        //     'status' => 1,
        //     'phone_number' => '(021) 5737494',
        //     'email' => 'nasmarafaur@gmail.com',
        //     'password' => Hash::make('123123')
        // ]);
        // $a2->assignRole('operator');

        // $a3 = User::create([
        //     'name' => 'Riki Samara',
        //     'photo' => 'apple-icon_1640267953.png',
        //     'place_born' => 'Semarang',
        //     'date_of_birth' => '2021-12-22',
        //     'gender' => 1,
        //     'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
        //     'sk_number' => 'SK II /132.343.34235/Atlet/4234',
        //     'sk_file' => 'apple-icon_1640267953.png',
        //     'sk_date_from' => '2021-12-22',
        //     'sk_date_to' => '2021-12-31',
        //     'position' => 2,
        //     'status' => 1,
        //     'phone_number' => '(021) 5737494',
        //     'email' => 'rikisamara@gmail.com',
        //     'password' => Hash::make('123123')
        // ]);
        // $a3->assignRole('operator');

        // $a4 = User::create([
        //     'name' => 'Fidriawan Ari',
        //     'photo' => 'apple-icon_1640267953.png',
        //     'place_born' => 'Semarang',
        //     'date_of_birth' => '2021-12-22',
        //     'gender' => 1,
        //     'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
        //     'sk_number' => 'SK II /132.343.34235/Atlet/4234',
        //     'sk_file' => 'apple-icon_1640267953.png',
        //     'sk_date_from' => '2021-12-22',
        //     'sk_date_to' => '2021-12-31',
        //     'position' => 2,
        //     'status' => 1,
        //     'phone_number' => '(021) 5737494',
        //     'email' => 'atlet@gmail.com',
        //     'password' => Hash::make('123123')
        // ]);
        // $a4->assignRole('atlet');

        // $a5 = User::create([
        //     'name' => 'Fidriawan Aris',
        //     'photo' => 'apple-icon_1640267953.png',
        //     'place_born' => 'Semarang',
        //     'date_of_birth' => '2021-12-22',
        //     'gender' => 1,
        //     'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
        //     'sk_number' => 'SK II /132.343.34235/Atlet/4234',
        //     'sk_file' => 'apple-icon_1640267953.png',
        //     'sk_date_from' => '2021-12-22',
        //     'sk_date_to' => '2021-12-31',
        //     'position' => 2,
        //     'status' => 1,
        //     'phone_number' => '(021) 5737494',
        //     'email' => 'atlet1@gmail.com',
        //     'password' => Hash::make('123123')
        // ]);
        // $a5->assignRole('atlet');

        // $a6 = User::create([
        //     'name' => 'Fidriawan Ar',
        //     'photo' => 'apple-icon_1640267953.png',
        //     'place_born' => 'Semarang',
        //     'date_of_birth' => '2021-12-22',
        //     'gender' => 1,
        //     'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
        //     'sk_number' => 'SK II /132.343.34235/Atlet/4234',
        //     'sk_file' => 'apple-icon_1640267953.png',
        //     'sk_date_from' => '2021-12-22',
        //     'sk_date_to' => '2021-12-31',
        //     'position' => 2,
        //     'status' => 1,
        //     'phone_number' => '(021) 5737494',
        //     'email' => 'wasit@gmail.com',
        //     'password' => Hash::make('123123')
        // ]);
        // $a6->assignRole('wasit');

        // $a7 = User::create([
        //     'name' => 'Fidriawansa Ar',
        //     'photo' => 'apple-icon_1640267953.png',
        //     'place_born' => 'Semarang',
        //     'date_of_birth' => '2021-12-22',
        //     'gender' => 1,
        //     'address' => 'Jl. Malino, Borongloe, Bontomarannu, Kabupaten Gowa, Sulawesi Selatan 92119',
        //     'sk_number' => 'SK II /132.343.34235/Atlet/4234',
        //     'sk_file' => 'apple-icon_1640267953.png',
        //     'sk_date_from' => '2021-12-22',
        //     'sk_date_to' => '2021-12-31',
        //     'position' => 2,
        //     'status' => 1,
        //     'phone_number' => '(021) 5737494',
        //     'email' => 'pelatih@gmail.com',
        //     'password' => Hash::make('123123')
        // ]);
        // $a7->assignRole('pelatih');
    }
}
