<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveImageOnSliderTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      Schema::table('slider_translations', function(Blueprint $table) {

        $table->dropColumn('image_file_name');
        $table->dropColumn('image_file_size');
        $table->dropColumn('image_content_type');
        $table->dropColumn('image_updated_at');

      });
      Schema::table('sliders', function(Blueprint $table) {

        $table->string('image_file_name')->nullable();
        $table->integer('image_file_size')->nullable()->after('image_file_name');
        $table->string('image_content_type')->nullable()->after('image_file_size');
        $table->timestamp('image_updated_at')->nullable()->after('image_content_type');

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
      Schema::table('slider_translations', function(Blueprint $table) {
        $table->string('image_file_name')->nullable();
        $table->integer('image_file_size')->nullable()->after('image_file_name');
        $table->string('image_content_type')->nullable()->after('image_file_size');
        $table->timestamp('image_updated_at')->nullable()->after('image_content_type');
      });
      Schema::table('sliders', function(Blueprint $table) {

        $table->dropColumn('image_file_name');
        $table->dropColumn('image_file_size');
        $table->dropColumn('image_content_type');
        $table->dropColumn('image_updated_at');

      });
    }
}
