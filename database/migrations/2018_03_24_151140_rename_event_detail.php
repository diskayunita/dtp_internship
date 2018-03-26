<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameEventDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_translations', function (Blueprint $table) {
             $table->renameColumn('name_product', 'name');
             $table->renameColumn('language_product', 'language');
        });
        Schema::table('purpose_translations', function (Blueprint $table) {
             $table->renameColumn('name_purpose', 'name');
             $table->renameColumn('language_purpose', 'language');
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
