<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(AgenciesTableSeeder::class);
        $this->call(ParticipantsTableSeeder::class);
        $this->call(RoleAdminSeeder::class);
        $this->call(RoleIdexSeeder::class);
        // $this->call(IndonesiaProvincesTableSeeder::class);
        // $this->call(IndonesiaCitiesTableSeeder::class);
        // $this->call(IndonesiaDistrictsTableSeeder::class);
        // $this->call(IndonesiaVillagesTableSeeder::class);
    }
}
