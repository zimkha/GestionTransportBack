<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControletechniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controletechniques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('vehicule_id');
            $table->date('date_controle');
            $table->string('numero_pv');
            $table->string('defaillance');
            $table->unsignedInteger('resultatcontrole_id');
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
        Schema::dropIfExists('controletechniques');
    }
}
