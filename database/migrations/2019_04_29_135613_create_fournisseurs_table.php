<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornisseurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_fournisseur');
            $table->string('adresse');
            $table->string('telephone');
            $table->unsignedInteger('typefournisseur_id');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornisseurs');
    }
}
