<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandemarchandisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandemarchandises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('marchandise_id');
            $table->unsignedInteger('commande_id');
            $table->integer('qte_commander');
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
        Schema::dropIfExists('commandemarchandises');
    }
}
