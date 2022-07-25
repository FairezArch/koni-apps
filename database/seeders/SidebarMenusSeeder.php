<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SidebarMenu;

class SidebarMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $parents = [
            'Beranda',
            // 'Atlet Terverifikasi',
            // 'Verifikasi Atlet',
            'Pelatih',
            // 'Wasit',
            'Wasit & Juri',
            'Cabang Olahraga',
            'Club',
            'Nomor',
            'Atlet',
            // 'Wasit & Juri',
            'Berita Tampil',
            'Semua Berita',
            'Request Berita',
            'kategori Berita',
            'Kalendar Kegiatan',
            'Admin',
            'Role & Permission',
            'Pengaturan Umum',
            'Pengaturan Privacy & Policy',
            'Pengaturan Landing Page',
            'Pengaturan Pelatih',
            'Pengaturan Wasit & Juri',
            'Galeri'
        ];

        SidebarMenu::query()->truncate();
        foreach($parents as $parent){
            SidebarMenu::insert(['name_menu'=>$parent]);
        }
    }
}
