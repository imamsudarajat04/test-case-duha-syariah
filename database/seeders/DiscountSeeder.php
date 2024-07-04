<?php

namespace Database\Seeders;

use App\Models\Discounts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Diskon 10% untuk semua produk
        Discounts::create([
            'code' => 'FA111',
            'type' => 'percentage',
            'value' => 10,
        ]);

        // Diskon 50rb untuk produk dengan kode FA4532
        Discounts::create([
            'code' => 'FA222',
            'type' => 'fixed',
            'value' => 50000,
            'product_code' => 'FA4532',
        ]);

        // Diskon 6% untuk produk di atas 400 ribu
        Discounts::create([
            'code' => 'FA333',
            'type' => 'price_specific',
            'value' => 6,
        ]);

        // Diskon 5% untuk pembelian di hari Selasa jam 13:00 s/d 15:00
        Discounts::create([
            'code' => 'FA444',
            'type' => 'time_specific',
            'value' => 5,
        ]);
    }
}
