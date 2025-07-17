<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajout des nouvelles colonnes
            $table->string('nom')->nullable();      // Ajout de la colonne 'nom'
            $table->string('prenom')->nullable();   // Ajout de la colonne 'prenom'
            $table->string('status')->nullable();   // Ajout de la colonne 'status'
            $table->string('service')->nullable();  // Ajout de la colonne 'service'
            $table->string('image')->nullable();    // Ajout de la colonne 'image'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Suppression des colonnes ajoutées
            $table->dropColumn(['nom', 'prenom', 'status', 'service', 'image']);
        });
    }
};
