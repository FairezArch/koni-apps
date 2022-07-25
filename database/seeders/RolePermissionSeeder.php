<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        //
        $permissions = [
            '1' => ['dashboard'],
            // '2' =>  [
            //     'atlet-verify-list',
            //     'atlet-verify-create',
            //     'atlet-verify-edit',
            //     'atlet-verify-show',
            //     'atlet-verify-delete'
            // ],
            // '3' =>  [
            //     'atlet-need-verification-list',
            //     'atlet-need-verification-edit'
            // ],
            '2' =>  [
                'trainer-list',
                'trainer-create',
                'trainer-edit',
                'trainer-show',
                'trainer-delete'
            ],
            // '5' =>  [
            //     'referee-list',
            //     'referee-create',
            //     'referee-edit',
            //     'referee-show',
            //     'referee-delete'
            // ],
            '3' =>  [
                'judge-list',
                'judge-create',
                'judge-edit',
                'judge-show',
                'judge-delete'
            ],
            '4' =>  [
                'sportbranch-list',
                'sportbranch-create',
                'sportbranch-edit',
                'sportbranch-show',
                'sportbranch-delete'
            ],
            '5' =>  [
                'club-list',
                'club-create',
                'club-edit',
                'club-show',
                'club-delete'
            ],
            '6' =>  [
                'nomor-list',
                'nomor-create',
                'nomor-edit',
                'nomor-show',
                'nomor-delete'
            ],
            '7' =>  [
                'atlet-list',
                'atlet-create',
                'atlet-edit',
                'atlet-show',
                'atlet-delete'
            ],
            // '11' =>  [
            //     'referee-judge-list',
            //     'referee-judge-create',
            //     'referee-judge-edit',
            //     'referee-judge-show',
            //     'referee-judge-delete'
            // ],
            '8' =>  [
                'news-topnews-list',
                'news-topnews-create',
                'news-topnews-edit',
                'news-topnews-show',
                'news-topnews-delete',
            ],
            '9' =>  [
                'news-newsscheduled-list',
                'news-newsscheduled-create',
                'news-newsscheduled-edit',
                'news-newsscheduled-show',
                'news-newsscheduled-delete',
            ],
            '10' =>  [
                'news-requestnews-list',
                'news-requestnews-create',
                'news-requestnews-edit',
                'news-requestnews-show',
                'news-requestnews-delete',
            ],
            '11' =>  [
                'category-news-list',
                'category-news-create',
                'category-news-edit',
                'category-news-show',
                'category-news-delete',
            ],
            '12' =>  [
                'calendar-list',
                'calendar-create',
                'calendar-edit',
                'calendar-show',
                'calendar-delete'
            ],
            '13' =>  [
                'admin-list',
                'admin-create',
                'admin-edit',
                'admin-show',
                'admin-delete'
            ],
            '14' =>  [
                'rolepermisson-list',
                'rolepermisson-create',
                'rolepermisson-edit',
                'rolepermisson-show',
                'rolepermisson-delete'
            ],
            '15' =>  [
                'general-setting-list',
                'general-setting-create',
            ],
            '16' =>  [
                'privacy-policy-setting-list',
                'privacy-policy-setting-create',
            ],
            '17' =>  [
                'landing-page-setting-list',
                'landing-page-setting-create',
            ],
            '18' =>  [
                'trainer-setting-list',
                'trainer-setting-create',
                'trainer-setting-edit',
                'trainer-setting-show',
                'trainer-setting-delete'
            ],
            '19' =>  [
                'referee-judge-setting-list',
                'referee-judge-setting-create',
                'referee-judge-setting-edit',
                'referee-judge-setting-show',
                'referee-judge-setting-delete'
            ],
            '20' => [
                'gallery-list',
                'gallery-create',
            ]
        ];

        $res = [];
        foreach ($permissions as $permission => $values) {
            foreach ($values as $value) {
                $res[] = ['name' => $value, 'guard_name' => 'web', 'parent' => $permission];
            }
        }

        Permission::insert($res);


        $role = Role::create(['name' => 'superadmin','guard_name' => 'web']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'koni','guard_name' => 'web']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'adminutama','guard_name' => 'web']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'cabor','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        $role = Role::create(['name' => 'club','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        $role = Role::create(['name' => 'atlet','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        $role = Role::create(['name' => 'humascabor','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        $role = Role::create(['name' => 'humaskoni','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        $role = Role::create(['name' => 'sport','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        $role = Role::create(['name' => 'trainer','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        $role = Role::create(['name' => 'judge','guard_name' => 'web']);
        $role->givePermissionTo('dashboard');

        
    }
}
