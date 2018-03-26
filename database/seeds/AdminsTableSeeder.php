<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Admin;
use App\Role;
use App\Permission;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // this is for superadmin
        $superadmin = new Role();
        $superadmin->name         = 'superadmin';
        $superadmin->display_name = 'User Super Administrator'; // optional
        $superadmin->description  = 'User is allowed to manage and edit all features'; // optional
        $superadmin->save();

        $editUser = new Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit Users'; // optional
        $editUser->description  = 'edit existing users'; // optional
        $editUser->save();

        $createUser = new Permission();
        $createUser->name         = 'create-user';
        $createUser->display_name = 'Create Users'; // optional
        $createUser->description  = 'create new users'; // optional
        $createUser->save();

        $admin_user = new Admin(
            [
                'name' => 'superadmin',
                'email' => 'superadmin@telkom-dds.com',
                'password' => bcrypt('password'),
            ]
        );


        if ($admin_user->save()) {
            $admin_user->attachRole($superadmin);
            $superadmin->attachPermissions([$createUser, $editUser]);
        }
    }
}
