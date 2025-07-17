<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('nom', 255)->after('name')->nullable();
            $table->string('prenom', 255)->after('nom')->nullable();
            $table->string('status', 50)->after('prenom')->nullable();
            $table->string('service', 100)->after('status')->nullable();
            $table->string('image', 255)->after('service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['nom', 'prenom', 'status', 'service', 'image']);
        });
    }
}
