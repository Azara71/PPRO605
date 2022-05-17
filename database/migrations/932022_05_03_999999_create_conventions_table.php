<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConventionsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('conventions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('chemin_convention');
            $table->date('date_creation');
            $table->date('date_derniere_modification');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->foreignId('procedure_id')->constrained(); // Laravel trouve automatiquement grâce à un alias l'id dans la table procedure.
            $table->timestamps();
            $table->unsignedBigInteger('tuteur_id')->nullable();
            $table->foreign('tuteur_id')->references('id')->on('users');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('conventions');
    }
}
