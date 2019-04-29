<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ep_nomcomplet', 100);
            $table->string('ep_nci', 20);
            $table->string('ep_adresse');
            $table->enum('ep_situation_m', ['célibataire', 'marié', 'divorcé']);
            $table->integer('ep_nb_enfants')->nullable();
            $table->string('ep_poste', 30);
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
        Schema::dropIfExists('employes');
    }
}
