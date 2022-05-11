<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            'nom_job'=>'Directeur de faculté',
        ]);
        DB::table('jobs')->insert(['nom_job'=>'PDG',        ]);
        DB::table('jobs')->insert(['nom_job'=>'Développeur',        ]);
        DB::table('jobs')->insert(['nom_job'=>'Intégrateur front-end',        ]);
        DB::table('jobs')->insert(['nom_job'=>'Banquier',        ]);
        DB::table('jobs')->insert(['nom_job'=>'Professeur informatique',        ]);
        DB::table('jobs')->insert(['nom_job'=>'Gérant Licence',        ]);

        DB::table('universités')->insert([
            'nom_université' => 'Univ de toto',
            'adresse_université' => 'Adrr univ de toto',
        ]);
        DB::table('facultes')->insert([
            'nom_faculte' => 'Faculté de toto',
            'adresse_faculte' => 'Adrr faculté de toto',
            'université_id'=>'1',
        ]);
        DB::table('etudiants')->insert([
            'num_etudiant' => '1111111',
            'annee' => 'L1',
        ]);
        DB::table('pivot_table_etudiant_faculte')->insert([
            'etudiant_id' => '1',
            'faculte_id' => '1',
        ]);
        DB::table('users')->insert([
            'prenom' => 'totoetudiant',
            'nom' => 'totoetudiant',
            'statut'=>'Etudiant',
            'email' => 'totoetudiant@totoetudiant.fr',
            'password' => '$2y$10$mScMZRDF6cZKsYoHgUDtY.KhM.ByeG9DQqpsY3nLmLsDR1IyryjAm', // totoprof
            'etudiant_id'=>'1',
        ]);
        DB::table('entreprises')->insert([
            'nom_entreprise'=>'Entreprise de Toto',
            'num_siret'=>'11111111111111',
            'adresse_entreprise'=>'12 rue de Toto',
        ]);
        DB::table('pivot_table_ent_fac_job')->insert([
            'entreprise_id'=>'1',
            'job_id'=>'2',
        ]);
        DB::table('pivot_table_ent_fac_job')->insert([
            'entreprise_id'=>'1',
            'job_id'=>'3',
        ]);
       DB::table('travailleurs')->insert([
        'job_id'=>'2',
       ]);
       DB::table('travailleurs')->insert([
        'job_id'=>'7',
       ]);
       DB::table('pivot_table_ent_fac_job')->insert([
        'faculte_id'=>'1',
        'job_id'=>'7',
   ]);
       
        DB::table('users')->insert([
            'prenom' => 'totoentreprise',
            'nom' => 'totoentreprise',
            'statut'=>'Entreprise',
            'email' => 'totoentreprise@totoentreprise.fr',
            'password' => '$2y$10$mScMZRDF6cZKsYoHgUDtY.KhM.ByeG9DQqpsY3nLmLsDR1IyryjAm', // totoprof
            'travailleur_id'=>'1'
        ]);
        DB::table('pivot_table_ent_trav_univ')->insert([
            'travailleur_id'=>'1',
            'entreprise_id'=>'1',
        ]);
        DB::table('pivot_table_ent_trav_univ')->insert([
            'travailleur_id'=>'2',
            'université_id'=>'1',

        ]);
        DB::table('users')->insert([
            'prenom' => 'totoprof',
            'nom' => 'totoprof',
            'statut'=>'Université',
            'email' => 'totoprof@totoprof.fr',
            'password' => '$2y$10$mScMZRDF6cZKsYoHgUDtY.KhM.ByeG9DQqpsY3nLmLsDR1IyryjAm', // totoprof
            'travailleur_id'=>'2'
        ]);

             // \App\Models\User::factory(10)->create();
             \App\Models\Université::factory(5)->create();
             \App\Models\Faculte::factory(4)->create();
             \App\Models\Entreprise::factory(5)->create();
    }
}
