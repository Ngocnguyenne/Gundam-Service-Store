<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa các danh mục cũ và thay bằng danh mục mới

        Categories::create([
            'id' => 1,
            'name' => 'Dịch vụ',
            'path' => '/dich-vu',
            'is_show_in_nav' => 1
        ]);

        Categories::create([
            'id' => 2,
            'name' => 'Dụng cụ & Phụ kiện',
            'path' => '/dung-cu-phu-kien',
            'is_show_in_nav' => 1
        ]);

        
         Categories::create([
            'id' => 3,
            'name' => 'Mô hình Lắp ráp (Gunpla)',
            'path' => '/mo-hinh-lap-rap',
            'is_show_in_nav' => 1
        ]);

        Categories::create([
            'id' => 4,
            'name' => 'Figure & Hàng sưu tầm',
            'path' => '/figure-hang-suu-tam',
            'is_show_in_nav' => 1
        ]);
    }
}