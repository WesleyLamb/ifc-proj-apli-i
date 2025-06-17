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
        Schema::create('license_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('license_id');
            $table->foreignId('application_id');

            $table->foreign('license_id')->references('id')->on('licenses');
            $table->foreign('application_id')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_applications');
    }
};
