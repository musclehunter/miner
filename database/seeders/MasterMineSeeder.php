<?php

namespace Database\Seeders;

use App\Models\MasterMine;
use Database\Factories\MasterMineFactory;
use Illuminate\Database\Seeder;

class MasterMineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterMine::create(['name' => "鉱山1", 'distance' => 5, 'description' => "すごく近くにある鉱山"]);
        MasterMine::create(['name' => "鉱山2", 'distance' => 15, 'description' => "ちょっと離れたところにある鉱山"]);
        MasterMine::create(['name' => "鉱山3", 'distance' => 20, 'description' => "離れたところにある鉱山"]);
        MasterMine::create(['name' => "鉱山4", 'distance' => 30, 'description' => "すごく離れたところにある鉱山"]);
    }
}
