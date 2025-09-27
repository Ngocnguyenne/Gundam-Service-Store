<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::create([
            'id' => 1,
            'title' => 'Banner header',
            'image_path' => 'images/banner-1.jpg',
            'position' => '0'
        ]);

        Banner::create([
            'id' => 2,
            'title' => 'Banner header',
            'image_path' => 'images/banner-2.jpg',
            'position' => '0'
        ]);

        Banner::create([
            'id' => 3,
            'title' => 'Banner header',
            'image_path' => 'images/banner-3.jpg',
            'position' => '0'
        ]);
    }
}
