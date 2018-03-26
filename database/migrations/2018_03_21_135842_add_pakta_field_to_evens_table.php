<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaktaFieldToEvensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function(Blueprint $table) {

            $table->string('pakta_file_name')->nullable();
            $table->integer('pakta_file_size')->nullable()->after('pakta_file_name');
            $table->string('pakta_content_type')->nullable()->after('pakta_file_size');
            $table->timestamp('pakta_updated_at')->nullable()->after('pakta_content_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('events', function(Blueprint $table) {

            $table->dropColumn('pakta_file_name');
            $table->dropColumn('pakta_file_size');
            $table->dropColumn('pakta_content_type');
            $table->dropColumn('pakta_updated_at');

        });
    }
}
