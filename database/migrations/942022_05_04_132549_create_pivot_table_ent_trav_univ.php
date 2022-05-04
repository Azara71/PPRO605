<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableEntTravUniv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_table_ent_trav_univ', function (Blueprint $table) {
            $table->foreignId('travailleur_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('université_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('entreprise_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('pivot_table_ent_trav_univ');
    }
}
