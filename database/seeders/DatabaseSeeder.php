<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Université::factory(2)->create();
        \App\Models\Faculte::factory(4)->create();
        \App\Models\Entreprise::factory(5)->create();
    }
}
