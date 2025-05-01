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
                'keyword' => 'Desain Vektor, corel, photoshop,sketchup, autocad',
                'price' => 3000000,
            ],
            [
                'name' => 'ASUS X450C',
                'processor' => 'intel core i3-3217U',
                'ram' => '4 GB',
                'storage' => 'HDD 500 GB',
                'gpu' => 'intel HD Graphics 4000',
                'keyword' => 'kantoran,kasir, admin,corel,photoshop ,desain',
                'price' => 2300000,
            ],
            [
                'name' => 'ASUS A455L',
                'processor' => 'intel core i3-5005u',
                'ram' => '4 GB',
                'storage' => 'HDD 500 GB',
                'gpu' => 'intel HD Graphics 5500',
                'keyword' => 'kantoran, corel,photoshop,desain',
                'price' => 2500000,
            ],
            [
                'name' => 'ACER ASPIRE ES1-432',
                'processor' => 'intel celeron N3350',
                'ram' => '4 GB',
                'storage' => 'HDD 500 GB',
                'gpu' => 'intel HD Grapics',
                'keyword' => 'kantoran, pemula,',
                'price' => 2000000,
            ],
            [
                'name' => 'ASUS X441S',
                'processor' => 'intel core i3-6006u',
                'ram' => '4 GB',
                'storage' => 'SSD 128 GB',
                'gpu' => 'NVDIA Geforce MX110, intel HD Graphics 620',
                'keyword' => 'Desain Vektor, corel, photoshop,sketchup, autocad',
                'price' => 3000000,
            ],
            // Tambahan baris selanjutnya jika ada ...
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
