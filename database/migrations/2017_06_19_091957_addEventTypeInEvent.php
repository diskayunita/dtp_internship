<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventTypeInEvent extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('type')->after('session');
            $table->string('session')->change();;
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
