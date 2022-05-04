<?php

use App\Models\Etudiant;
use App\Models\Travailleur;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('prenom');
            $table->string('nom');
            $table->string('nom_utilisateur');
            $table->integer('statut');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('etudiant_id')->nullable()->constrained();
            $table->foreignId('travailleur_id')->nullable()->constrained();
            $table->rememberToken();
            $table->timestamps();
           
        });
    }
  

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
