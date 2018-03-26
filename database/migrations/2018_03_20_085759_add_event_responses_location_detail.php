<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventResponsesLocationDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_responses', function (Blueprint $table) {

            $table->string('location')->nullable();
            $table->dropColumn('reference_number');
            
        });
        Schema::table('events', function (Blueprint $table) {

            $table->dropColumn('reference_number');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
