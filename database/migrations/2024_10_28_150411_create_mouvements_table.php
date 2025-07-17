<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouvementsTable extends Migration
{
    public function up()
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id('id_mouvement');
            $table->foreignId('id_produit')->constrained('produits', 'id_produit');
            $table->foreignId('id_administrateur')->constrained('admins', 'id');
            $table->integer('quantité');
            $table->string('type');
            $table->date('date_mouvements');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mouvements');
    }
}
