<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PrivacyPolicySeeder::class);
        $this->call(SettingLandingPageSeeder::class);
        $this->call(SidebarMenusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriesNewsSeeder::class);
        $this->call(SportsSeeder::class);
        $this->call(EmploySeeder::class);
    }
}
