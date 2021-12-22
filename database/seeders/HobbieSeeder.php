<?php

namespace Database\Seeders;

use App\Models\Hobbie;
use Illuminate\Database\Seeder;

class HobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hobbie::factory()->count(10)->create();
    }
}
