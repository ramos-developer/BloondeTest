<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Hobbie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerHobbieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'hobbie_id' => Hobbie::inRandomOrder()->first()->id
        ];
    }
}
