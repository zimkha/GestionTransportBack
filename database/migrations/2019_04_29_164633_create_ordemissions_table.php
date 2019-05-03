<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordemissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('reception_id');
            $table->boolean('statut');
            $table->unsignedInteger('livraison_id')->nullable();
            $table->unsignedInteger('fraisnote_id')->nullable();
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
        Schema::dropIfExists('ordemissions');
    }
}
