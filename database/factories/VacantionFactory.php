<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VacantionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start' => now(),
            'end' => now()->addDays(7),
            'price' => 100.00,
        ];
    }
}
