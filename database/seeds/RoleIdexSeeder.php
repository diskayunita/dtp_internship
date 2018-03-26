<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Admin;
use App\Role;

class RoleIdexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idexs = new Admin(
            [
                'name' => 'idex',
                'email' => 'idex@telkom-dds.com',
                'password' => bcrypt('password'),
            ]
        );

        $idex = new Role();
        $idex->name         = 'idex';
        $idex->display_name = 'User Idex'; // optional
        $idex->description  = 'User is allowed to create all content'; // optional
        $idex->save();

        if($idexs->save()){
            $idexs->attachRole($idex);
        }
    }
}
