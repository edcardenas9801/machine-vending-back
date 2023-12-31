<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MachinesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(InventoriesTableSeeder::class);
    }
}
