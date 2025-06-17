<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_establishment_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_establishment_id');
            $table->string('permission');

            $table->foreign('user_establishment_id')->references('id')->on('users_establishments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_establishment_permissions');
    }
};
