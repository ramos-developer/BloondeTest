<?php

namespace Database\Seeders;

use App\Models\CustomerHobbie;
use Illuminate\Database\Seeder;

class CustomerHobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerHobbie::factory()->count(50)->create();
    }
}
