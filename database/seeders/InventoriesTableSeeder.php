<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::create([
            'article_id' => 1,
            'quantity_available' => 5,
            'purchased_amount' => 0,
        ]);

        Inventory::create([
            'article_id' => 2,
            'quantity_available' => 5,
            'purchased_amount' => 0,
        ]);

        Inventory::create([
            'article_id' => 3,
            'quantity_available' => 5,
            'purchased_amount' => 0,
        ]);

        Inventory::create([
            'article_id' => 4,
            'quantity_available' => 5,
            'purchased_amount' => 0,
        ]);
    }
}
