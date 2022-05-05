<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaculteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_faculte'=>$this->faker->company(),
            'adresse_faculte'=>$this->faker->streetAddress(),
            'created_at'=>now(),
            'université_id'=>rand(1,4),
        ];
    }
}
