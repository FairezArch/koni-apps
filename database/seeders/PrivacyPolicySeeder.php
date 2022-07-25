<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Privacypolicy;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Privacypolicy::create([
            'privacy' => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi dolorum autem amet corporis adipisci dicta beatae non commodi possimus, maiores repellat blanditiis accusamus magni minima recusandae iure tempora, ducimus accusantium.",
            'policy' => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi dolorum autem amet corporis adipisci dicta beatae non commodi possimus, maiores repellat blanditiis accusamus magni minima recusandae iure tempora, ducimus accusantium."
        ]);
    }
}
