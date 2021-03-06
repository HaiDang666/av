<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('unknown');;
            $table->unsignedInteger('movie_count')->default(0);
            $table->string('image')->default('');
            $table->string('thumbnail')->default('');
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
        Schema::dropIfExists('actresses');
    }
}
