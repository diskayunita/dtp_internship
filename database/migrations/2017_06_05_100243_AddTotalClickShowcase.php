<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalClickShowcase extends Migration
{
    public function up()
    {
        Schema::table('showcases', function(Blueprint $table) {
            $table->integer('total_view')->nullable()->default(0);
            $table->integer('total_share')->nullable()->default(0);
        });
    }

    public function down()
    {
        Schema::table('showcases', function(Blueprint $table) {
            $table->dropColumn('total_view');
            $table->dropColumn('total_share');
        });
    }
}
