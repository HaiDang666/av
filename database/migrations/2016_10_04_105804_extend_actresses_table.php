<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendActressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actresses', function (Blueprint $table) {
            $table->string('alias')->nullable()->after('name');
            $table->smallInteger('debut')->nullable()->after('alias');
            $table->string('measurements')->nullable()->after('debut');
            $table->date('dob')->nullable()->after('measurements');
            $table->smallInteger('rate')->default(0)->after('dob');
            $table->string('note')->nullable()->after('rate');
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
            $table->dropColumn(['alias', 'debut', 'measurements', 'dob', 'rate', 'note']);
        });
    }
}
