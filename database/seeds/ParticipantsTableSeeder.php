<?php

use Illuminate\Database\Seeder;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('participant_limits')->truncate();

        // Datacell
        DB::table('participant_limits')->insert([
            'minimal' => 30,
            'maximal' => 70,
            'description' => 'limited for 70 participants'
        ]);
    }
}
