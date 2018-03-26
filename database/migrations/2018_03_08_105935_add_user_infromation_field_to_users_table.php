<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInfromationFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('university')->nullable();
            $table->string('nim')->nullable();
            $table->string('major')->nullable();
            $table->string('faculty')->nullable();
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

            $table->dropColumn('university')->nullable();
            $table->dropColumn('nim')->nullable();
            $table->dropColumn('major')->nullable();
            $table->dropColumn('faculty')->nullable();
        });
    }
}
