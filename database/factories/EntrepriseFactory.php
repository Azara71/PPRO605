<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $chiffre_1=$this->faker->randomNumber(7, $strict = true); 
        $chiffre_2=$this->faker->randomNumber(7, $strict = true);
      
        return [
            'nom_entreprise'=>$this->faker->company(),
            'num_siret'=>$chiffre_1.$chiffre_2,
            'adresse_entreprise'=>$this->faker->streetAddress(),
        ];
    }
}
