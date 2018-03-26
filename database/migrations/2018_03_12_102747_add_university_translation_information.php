<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniversityTranslationInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('university_translations', function (Blueprint $table) {

            $table->string('language');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('university_id')->unsigned();
            $table->foreign('university_id')->references('id')->on('universities')->onUpdate('cascade')->onDelete('cascade');
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
