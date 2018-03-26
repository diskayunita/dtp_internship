<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageURLForGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_translations', function (Blueprint $table) {
            $table->string('image_url_zoomed')->nullable();
            $table->string('image_url_notzoom')->nullable()->after('image_url_zoomed');
            $table->string('image_url_medium')->nullable()->after('image_url_notzoom');
            $table->timestamp('image_url_thumb')->nullable()->after('image_url_medium');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_translations', function (Blueprint $table) {
            $table->dropColumn('image_url_zoomed');
            $table->dropColumn('image_url_notzoom');
            $table->dropColumn('image_url_medium');
            $table->dropColumn('image_url_thumb');
        });
    }
}
