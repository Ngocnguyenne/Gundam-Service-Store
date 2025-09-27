<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seeder settings default - don't change
        $configurations = [
            [
                'key' => 'site_name',
                'value' => ''
            ],
            [
                'key' => 'site_description',
                'value' => 'CHÀO MỪNG ĐẾN Gundam Service & Store - KHÔNG CHỈ LÀ MÔ HÌNH, ĐÓ LÀ ĐAM MÊ'
            ],
            [
                'key' =>'site_slogan',
                'value' => '"Lắp ráp đam mê, kiến tạo huyền thoại."'
            ],
            [
                'key' =>'site_slogan_description',
                'value' => '[Gundam Service & Store]: Vũ trụ Gunpla, nơi builder hội tụ."'
            ],
            [
                'key' => 'logo',
                'value' => 'frontend/img/logo.jpg'
            ],
            [
                'key' => 'address_shop',
                'value' => 'Hà Nội'
            ],
            [
                'key' => 'phone_shop',
                'value' => '0876101761'
            ],
            [
                'key' => 'email_shop',
                'value' => 'kiritongoc2k4@gmail.com'
            ],
            [
                'key' => 'facebook_link',
                'value' => 'https://www.facebook.com/ngoc.nguyen.998439'
            ],
            [
                'key' => 'instagram_link',
                'value' => 'https://instagram.com'
            ],
            [
                'key' => 'tiktok_link',
                'value' => 'https://tiktok.com'
            ],
            [
                'key' => 'services_firt',
                'value' => 'Nguồn Cung Cấp Toàn Diện & Cam Kết Chính Hãng'
            ],
            [
                'key' =>'color_services_firt',
                'value' => '#3674B5'
            ],
            [
                'key' => 'icon_services_firt',
                'value' => 'fas fa-shipping-fast'
            ],
            [
                'key' => 'services_second',
                'value' => 'Tư Vấn Chuyên Sâu & Đóng Gói Chuẩn Sưu Tầm'
            ],
            [
                'key' =>'color_services_second',
                'value' => '#578FCA'
            ],
            [
                'key' => 'icon_services_second',
                'value' => 'fas fa-stethoscope'
            ],
            [
                'key' => 'services_third',
                'value' => 'Xây Dựng Cộng Đồng & Ưu Đãi Đặc Quyền'
            ],
            [
                'key' =>'color_services_third',
                'value' => '#7AE2CF'
            ],
            [
                'key' => 'icon_services_third',
                'value' => 'fas fa-bath'
            ],
            [
                'key' => 'services_fourth',
                'value' => 'Trải Nghiệm Mua Sắm Thông Minh & Kênh Thông Tin Chuyên Sâu'
            ],
            [
                'key' =>'color_services_fourth',
                'value' => '#077A7D'
            ],
            [
                'key' => 'icon_services_fourth',
                'value' => 'fas fa-paw'
            ],
            [
                'key' =>'text_color',
                'value' => '#ffffff'
            ]
        ];

        Configuration::insert($configurations);
    }
}
