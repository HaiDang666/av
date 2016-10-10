<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendActressesTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actresses', function (Blueprint $table) {
            $table->smallInteger('height')->defautl(0);
            $table->smallInteger('weight')->defautl(0);
            $table->string('cup_size', 1)->defautl(0);
            $table->string('pob', 100)->default('')->after('dob');
            $table->string('description', 300)->default('');
            $table->string('jp_name', 50)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actresses', function (Blueprint $table) {
            $table->dropColumn(['height', 'weight', 'cup_size', 'pod', 'description' , 'jp_name']);
        });
    }
}
