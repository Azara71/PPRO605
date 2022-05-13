<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableModeleprocedureEtape extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_table_modeleprocedure_etape', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_modeles_id')->constrained()->onDelete('cascade');
            $table->foreignId('etape_modele_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('pivot_table_modeleprocedure_etape');
    }
}
