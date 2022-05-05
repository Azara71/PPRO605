<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UniversitéFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_université'=>$this->faker->company(),
            'adresse_université'=>$this->faker->streetAddress(),
            'created_at'=>now(),
        ];
    }
}
