<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id('id_produit'); // id_produit avec AUTO_INCREMENT
            $table->string('nom', 100); // nom VARCHAR(100)
            $table->text('description')->nullable(); // description TEXT, nullable
            $table->decimal('prix', 10, 2); // prix DECIMAL(10,2)
            $table->integer('quantité_actual'); // quantité_actual INT
            $table->integer('quantité_initial'); // quantité_initial INT
            $table->string('image', 255)->nullable(); // image VARCHAR(255), nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}

