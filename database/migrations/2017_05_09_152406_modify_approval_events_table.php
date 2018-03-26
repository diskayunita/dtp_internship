<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ModifyApprovalEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(config('database.default')==='mysql')
        {
            DB::statement('ALTER TABLE `events` MODIFY `approval` varchar(255) NULL;');
        }else{
            DB::statement('ALTER TABLE events ALTER COLUMN approval TYPE varchar(255);');
        }
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
