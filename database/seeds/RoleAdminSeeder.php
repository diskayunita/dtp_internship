<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Admin;
use App\Role;

class RoleAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = new Admin(
            [
                'name' => 'jurnalis',
                'email' => 'jurnalis@telkom-dds.com',
                'password' => bcrypt('password'),
            ]
        );

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Admin'; // optional
        $admin->description  = 'User is allowed to create all features'; // optional
        $admin->save();

        if($admins->save()){
            $admins->attachRole($admin);
        }
    }
}
