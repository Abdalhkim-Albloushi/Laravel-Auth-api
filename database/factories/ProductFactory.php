<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>User::all()->random()->id,
            'name'=>fake()->name(),
            'detail'=> fake()->text(),
            'size'=>fake()->randomElement(['M','L','S']),
            'price'=>fake()->randomElement(['2.200','3.500','1.200','0.300','5.900','1.000']),
            'qty'=>fake()->randomElement(['10','20','1','4','19','45']),

        ];
    }
}

