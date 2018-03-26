<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCofigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_cofigs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('minparticipant');
            $table->integer('maxparticipant');
            $table->date('blockeddate');
            $table->date('minimumdate');
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
        Schema::dropIfExists('event_cofigs');
    }
}
