<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avenants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->Integer('etat_avenant');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->foreignId('procedure_id')->constrained()->onDelete('cascade');; // Laravel trouve automatiquement grâce à un alias l'id dans la table procedure.
            $table->foreignId('convention_id')->constrained()->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avenants');
    }
}
