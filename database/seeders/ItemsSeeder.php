<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'ASUS X411U',
                'processor' => 'intel core i3-7020U',
                'ram' => '8 GB',
                'storage' => 'SSD 256 GB',
                'gpu' => 'NVDIA Geforce MX110, intel HD Graphics 620',
                'keyword' => 'Desain Vektor, corel, photoshop, sketchup, autocad, editing video',
                'price' => 3000000,
                'condition' => 'Bekas',
                'description' => 'Cocok untuk desain grafis dan editing video ringan',
            ],
            [
                'name' => 'ASUS X450C',
                'processor' => 'intel core i3-3217U',
                'ram' => '4 GB',
                'storage' => 'HDD 500 GB',
                'gpu' => 'intel HD Graphics 4000',
                'keyword' => 'kantoran, kasir, admin, corel, photoshop, desain',
                'price' => 2300000,
                'condition' => 'Bekas',
                'description' => 'Laptop kantoran yang hemat daya dan cukup untuk desain ringan',
            ],
            [
                'name' => 'ASUS A455L',
                'processor' => 'intel core i3-5005u',
                'ram' => '4 GB',
                'storage' => 'HDD 500 GB',
                'gpu' => 'intel HD Graphics 5500',
                'keyword' => 'kantoran, corel, photoshop, desain',
                'price' => 2500000,
                'condition' => 'Bekas',
                'description' => 'Performa seimbang untuk pekerjaan kantor dan desain ringan',
            ],
            [
                'name' => 'ACER ASPIRE ES1-432',
                'processor' => 'intel celeron N3350',
                'ram' => '4 GB',
                'storage' => 'HDD 500 GB',
                'gpu' => 'intel HD Graphics',
                'keyword' => 'kantoran, pemula',
                'price' => 2000000,
                'condition' => 'Bekas',
                'description' => 'Laptop ekonomis untuk pengguna pemula dan kebutuhan dasar',
            ],
            [
                'name' => 'ASUS X441S',
                'processor' => 'intel core i3-6006u',
                'ram' => '4 GB',
                'storage' => 'SSD 128 GB + HDD 500 GB',
                'gpu' => 'NVDIA Geforce MX110, intel HD Graphics 620',
                'keyword' => 'Desain Vektor, corel, photoshop, sketchup, autocad',
                'price' => 3000000,
                'condition' => 'Bekas',
                'description' => 'Dual storage dengan performa grafis cukup untuk desain menengah',
            ],
            [
                'name' => 'ASUS X455L',
                'processor' => 'intel core i3-4005u',
                'ram' => '4 GB',
                'storage' => 'SSD 128 GB + HDD 500 GB',
                'gpu' => 'intel HD Family',
                'keyword' => 'kantoran, corel, photoshop',
                'price' => 2500000,
                'condition' => 'Bekas',
                'description' => 'Laptop klasik untuk kebutuhan desain ringan dan kerja kantor',
            ],
            [
                'name' => 'THINKPAD',
                'processor' => 'intel core i5-6200u',
                'ram' => '8 GB',
                'storage' => 'SSD 128 GB',
                'gpu' => 'intel HD Graphics 520',
                'keyword' => 'corel, kantoran, photoshop',
                'price' => 2700000,
                'condition' => 'Bekas',
                'description' => 'Laptop bisnis handal dengan performa efisien',
            ],
            [
                'name' => 'ASUS X441N',
                'processor' => 'intel celeron N3350',
                'ram' => '2 GB',
                'storage' => 'SSD 128 GB + HDD 500 GB',
                'gpu' => 'intel HD Graphics',
                'keyword' => 'kantoran',
                'price' => 1900000,
                'condition' => 'Bekas',
                'description' => 'Pilihan murah meriah untuk pemakaian dasar',
            ],
            [
                'name' => 'ACER SF314-56',
                'processor' => 'intel Core i7-8565u',
                'ram' => '8 GB',
                'storage' => 'SSD 512 GB',
                'gpu' => 'NVDIA Geforce MX250, intel UHD Graphics 620',
                'keyword' => 'editing video, Desain Vektor, corel, photoshop, sketchup, autocad, programing web',
                'price' => 3800000,
                'condition' => 'Bekas',
                'description' => 'Laptop kelas atas untuk editing dan kebutuhan kreatif',
            ],
            [
                'name' => 'ASUS X441S',
                'processor' => 'intel celeron N3060',
                'ram' => '2 GB',
                'storage' => 'HDD 320 GB',
                'gpu' => 'intel Graphics',
                'keyword' => 'kantoran, pemula',
                'price' => 1700000,
                'condition' => 'Bekas',
                'description' => 'Cocok untuk pelajar dan tugas sekolah dasar',
            ],
            [
                'name' => 'AXIOO MYBOOK 14 F',
                'processor' => 'intel celeron 4020',
                'ram' => '6 GB',
                'storage' => 'SSD 256 GB',
                'gpu' => 'UHD Graphics 600',
                'keyword' => 'kantoran, office, admin',
                'price' => 2100000,
                'condition' => 'Bekas',
                'description' => 'Laptop ringan dan cukup cepat untuk admin/kantoran',
            ],
            [
                'name' => 'ASUS X451C',
                'processor' => 'intel core i3-3217u',
                'ram' => '8 GB',
                'storage' => 'SSD 256 GB + HDD 500 GB',
                'gpu' => 'intel HD Graphics 4000',
                'keyword' => 'corel, photoshop, desain, kantoran, admin',
                'price' => 2500000,
                'condition' => 'Bekas',
                'description' => 'Kapasitas besar dan RAM lega untuk kerja multitugas',
            ],
            // Tambahan baris selanjutnya jika ada ...
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
