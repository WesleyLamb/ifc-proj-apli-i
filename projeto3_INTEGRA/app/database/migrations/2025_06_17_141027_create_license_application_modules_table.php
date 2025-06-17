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
        Schema::create('license_application_modules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('license_application_id');
            $table->foreignId('module_id');

            $table->foreign('license_application_id')->references('id')->on('license_applications');
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_application_modules');
    }
};
