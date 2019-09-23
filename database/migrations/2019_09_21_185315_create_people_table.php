<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->integer('city_id')->nullable()->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('email')->unique()->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('file_name')->nullable(false);
			$table->string('file_mime')->nullable(false);
			$table->string('original_filename')->nullable(false);
			$table->string('file_path_to_show')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
