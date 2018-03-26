<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowcaseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcase_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('language');

            $table->string('title')->default('');
            
            $table->text('content');

            $table->integer('showcase_id')->unsigned();
            $table->foreign('showcase_id')->references('id')->on('showcases')->onUpdate('cascade')->onDelete('cascade');

            $table->string('slug')->unique();

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
        Schema::dropIfExists('showcase_translations');
    }
}
