<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEventDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_translations', function (Blueprint $table) {
             $table->renameColumn('name', 'name_product');
             $table->renameColumn('language', 'language_product');
        });
        Schema::table('purpose_translations', function (Blueprint $table) {
             $table->renameColumn('name', 'name_purpose');
             $table->renameColumn('language', 'language_purpose');
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
