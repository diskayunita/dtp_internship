<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;
use App\Permission;
use App\PermissionRole;
use App\Role;
use Validator;

class AdminController extends Controller
{
    //
    public function index()
    {
        $admins = Admin::all();
        $title = 'Admin List';
        return view('admin.index', compact('admins', 'title'));
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        $roles = Role::all();
        $title = "Admin Details";
        return view('admin.show', compact('admin', 'title', 'roles'));
    }

    public function create()
    {
        $admin = new Admin();
        $roles = Role::all();
        $adminrole = null;
        $title = 'Create New Admin';
        return view('admin.create', compact('admin', 'title', 'roles', 'adminrole'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.manage.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::find($input['role']);

        $admin = new Admin(
            [
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
            ]
        );

        if ($admin->save()) {
            $admin->attachRole($role);
        }

        flash('Admin successfully created', 'success');
        return redirect(route('admin.manage.index'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        if (isset($input['password'])) {
            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:admins,email,'.$id,
                'password' => 'required|min:6|confirmed',
            ]);
        } else {
            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:admins,email,'.$id,
            ]);
        }

        if ($validator->fails()) {
            return redirect(route('admin.manage.edit',[$id]))
            ->withErrors($validator)
            ->withInput();
        }
        
        $role = Role::find($input['role']);

        $admin = Admin::find($id);

        $admin->name     = $input['name'];
        $admin->email    = $input['email'];

        if (isset($input['password'])) {
            $admin->password = bcrypt($input['password']);
        }

        if ($admin->save()) {
            $admin->roles()->sync($role);
        }

        flash('Admin successfully updated', 'success');
        return redirect(route('admin.manage.index'));
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $permissions = Permission::all();
        $adminrole = $admin->roles()->first() ? $admin->roles()->first()->id : null;
        $roles = Role::all();
        $title = 'Edit admin';
        return view('admin.edit', compact('admin', 'title', 'permissions', 'adminrole', 'roles'));
    }

    public function permission(Request $request, $id, $method, $permission_id)
    {
        $admin = Admin::find($id);
        $role = $admin->roles()->first() ? $admin->roles()->first()->id : null;
        $permission = Permission::find($permission_id);
    
        if ($admin) {

            if ($method == 'delete') {
                $admin->roles()->first()->detachPermission($permission);
            }

            if ($method=='add') {
                if (!$admin->can($permission->name, true)) {
                    $admin->roles()->first()->attachPermission($permission);
                }   
            }

            flash('Permission '.$permission->name. ' has been '.$method);
            return redirect(route('admin.manage.index'));

        } else {

            flash('Manage permission has been failed');
        }
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);

        if ($admin) {
            $admin->delete();
            flash('Admin has been deleted successfully', 'success');
        } else {
            flash('Admin deleted failed', 'error');
        }

        flash('Admin successfully deleted', 'success');
        return redirect(route('admin.manage.index'));
    }
}
