<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('division_id')->unsigned();
            $table->foreign('division_id')->references('id')->on('divisions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('division_translations');
    }
}
