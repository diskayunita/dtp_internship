<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('gallery_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->string('language');
            $table->string('caption');
            $table->string('description')->nullable();

            $table->foreign('gallery_id')->references('id')->on('galleries')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('caption');
            $table->dropColumn('description');
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
        Schema::drop('gallery_translations');
    }
}
