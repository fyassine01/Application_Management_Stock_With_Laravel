<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('details_commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_commande');
            $table->unsignedBigInteger('id_produit');
            $table->integer('quantité');
            $table->timestamps();
    
            // Relations avec les tables 'commandes' et 'produits'
            $table->foreign('id_commande')->references('id')->on('commandes');
            $table->foreign('id_produit')->references('id_produit')->on('produits');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('details_commandes');
    }
    
};
