<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeDataSomeCollumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_cofigs', function (Blueprint $table) {
            $table->integer('minparticipant')->nullable()->change();
            $table->integer('maxparticipant')->nullable()->change();
            $table->integer('minimumdate')->nullable()->change();
            $table->date('blockeddate')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
