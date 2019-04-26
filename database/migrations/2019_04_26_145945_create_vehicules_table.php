<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vh_matricule')->unique();
            $table->unsignedInteger('vh_type');
            $table->float('vh_poids')->nullable();
            $table->float('vh_longueur')->nullable();
            $table->float('vh_hauteure')->nullable();
            $table->float('vh_largeur')->nullable();
            $table->float('vh_ptra')->nullable();
            $table->float('vh_ptac')->nullable();
            $table->integer('vh_essieu');
            $table->boolean('vh_statut');
            $table->boolean('vh_disponibilite');
            $table->mediumText('image')->nullable();
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
        Schema::dropIfExists('vehicules');
    }
}
