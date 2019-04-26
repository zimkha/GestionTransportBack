<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypecontratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typecontrats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_contrat');
            $table->integer('duree_max_en_mois')->nullable();
            $table->integer('duree_min_en_mois')->nullable();
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
        Schema::dropIfExists('typecontrats');
    }
}
