<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUserInfromationFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('phone_number');
            $table->dropColumn('jobs_name');
            $table->dropColumn('jobs_type');
            $table->dropColumn('gender');
            $table->dropColumn('birthdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('users', function (Blueprint $table) {

            $table->string('mobile_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('jobs_name')->nullable();
            $table->string('jobs_type')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthdate')->nullable();
        });
    }
}
