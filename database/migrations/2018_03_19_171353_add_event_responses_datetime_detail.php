<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventResponsesDatetimeDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_responses', function (Blueprint $table) {

            $table->date('date')->nullable();
            $table->time('time')->nullable();
            
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_responses', function (Blueprint $table) {

            $table->dropColumn('date')->nullable();
            $table->dropColumn('time')->nullable();
            
        });
    }
}
