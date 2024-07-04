<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::create([
            'code'  => 'FA4532',
            'name'  => 'Purple Reign FA',
            'price' => 455000,
            'image' => '//img.buyflowers.com.sg/p/6-purple-roses-spray-bouquet-with-medium-bear-fa4532-013',
        ]);

        Products::create([
            'code'  => 'FA3518',
            'name'  => 'Enchanting Belle',
            'price' => 366000,
            'image' => '//img.buyflowers.com.sg/p/indulge-in-the-beauty-of-our-enchanting-box-with-fa24888-024',
        ]);
    }
}
