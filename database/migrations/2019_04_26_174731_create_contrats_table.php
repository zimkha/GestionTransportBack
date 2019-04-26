<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('employe_id');
            $table->unsignedInteger('typecontrat_id');
            $table->date('date_debut_contrat');
            $table->date('date_fin_contrat')->nullable();   
            $table->boolean('status');
            $table->integer('salaire_brute')->nullable();
            $table->integer('salaire_net')->nullable(); 
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
        Schema::dropIfExists('contrats');
    }
}
