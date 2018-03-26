<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEventDetailFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {

            $table->dropColumn('agencies');
            $table->dropColumn('agencyname');
            $table->dropColumn('area');
            $table->dropColumn('number_participant');
            $table->dropColumn('province_id');
            $table->dropColumn('city_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::table('events', function (Blueprint $table) {

            $table->dropColumn('agencies')->nullable();
            $table->dropColumn('agencyname')->nullable();
            $table->dropColumn('area')->nullable();
            $table->dropColumn('number_participant')->nullable();
            $table->dropColumn('province_id')->nullable();
            $table->dropColumn('city_id')->nullable();
        });
    }
}
