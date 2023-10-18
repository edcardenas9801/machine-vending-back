<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Seeder;

class MachinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Machine::create([
            'coin_005' => 10,
            'coin_010' => 10,
            'coin_025' => 10,
            'coin_1' => 0
        ]);
    }
}
