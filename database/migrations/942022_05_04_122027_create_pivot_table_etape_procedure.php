<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableEtapeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_table_etape_procedure', function (Blueprint $table) {
            $table->foreignId('procedure_id')->constrained()->onDelete('cascade');
            $table->foreignId('etape_id')->constrained()->onDelete('cascade');
            $table->string('Etat');
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
        Schema::dropIfExists('pivot_table_etape_procedure');
    }
}
