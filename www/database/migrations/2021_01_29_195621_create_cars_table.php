<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rank_id')->constrained('ranks');
            $table->string('ownerName')->unique();
            $table->string('phone')->nullable();
            $table->foreignId('section_id')->constrained('sections');
            $table->foreignId('management_id')->constrained('management');
            $table->string('requestPermission')->nullable();
            $table->string('carNumber')->unique();
            $table->string('policeNumber')->nullable();
            $table->foreignId('car_type_id')->constrained('car_types');
            $table->foreignId('car_model_id')->constrained('car_models');
            $table->foreignId('color_id')->constrained('colors');
            $table->integer('carReleaseYear')->nullable();
            $table->string('garage')->nullable();
            $table->string('expairationDate')->nullable();
            $table->boolean('visitor')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
