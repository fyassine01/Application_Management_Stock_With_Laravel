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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->date('date_creation');
            $table->string('status');
            $table->timestamps();
    
            // Si tu as une relation avec une table 'clients'
            $table->foreign('id_client')->references('id')->on('users');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
    
};
