<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name')->default(NULL);
            $table->unsignedInteger('studio_id');
            $table->string('image')->default(NULL);
            $table->string('thumbnail')->default(NULL);
            $table->boolean('stored')->default(true);
            $table->timestamps();

            $table->index('studio_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
