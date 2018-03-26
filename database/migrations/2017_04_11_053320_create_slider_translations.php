<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('slider_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slider_id')->unsigned();
            $table->string('caption');
            $table->string('language');
            $table->text('description')->nullable();
            $table->string('referal_link')->nullable();

            $table->foreign('slider_id')->references('id')->on('sliders')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table('sliders', function(Blueprint $table) {

            $table->dropColumn('image_file_name');
            $table->dropColumn('image_file_size');
            $table->dropColumn('image_content_type');
            $table->dropColumn('image_updated_at');
            $table->dropColumn('description');
            $table->dropColumn('referal_link');
            $table->dropColumn('caption');
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
        Schema::drop('slider_translations');
        Schema::table('sliders', function(Blueprint $table) {

            $table->string('image_file_name')->nullable();
            $table->integer('image_file_size')->nullable()->after('image_file_name');
            $table->string('image_content_type')->nullable()->after('image_file_size');
            $table->timestamp('image_updated_at')->nullable()->after('image_content_type');

        });
    }
}
