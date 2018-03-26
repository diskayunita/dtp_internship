<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

Use App\Role;
Use App\Permission;
Use App\PermissionRole;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $title = "Role List";
        return view('admin.role.index', compact('roles', 'title'));
    }

    public function create()
    {
        $role = new Role();
        $title = "Role Create";
        return view('admin.role.create', compact('title', 'role'));
    }

    public function store(Request $request)
    {
        $input= $request->all();

        Role::create([
            'name' => $input['name'],
            'display_name'  => $input['display_name'], 
            'description'  => $input['description']
        ]);

        flash('Role successfully created', 'success');
        return redirect(route('admin.role.index'));
    }

    public function show($id)
    {
        //
        $role = Role::find($id);

        $title = $role ? $role->name : 'Role Details';

        return view('admin.role.show', compact('role', 'title'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        
        $permissions = Permission::all();

        $title = "Role Edit";
        return view('admin.role.edit', compact('title', 'role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $input= $request->all();

        $role = Role::find($id);
        $role->update([
            'name' => $input['name'],
            'display_name'  => $input['display_name'], 
            'description'  => $input['description']
        ]);
        
        flash('Role successfully updated', 'success');
        return redirect(route('admin.role.index'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        
        if ($role) {
            $role->delete();
            flash('Role successfully deleted', 'success');
        } else {
            flash('Role unsuccessfully deleted', 'error');
        }
        
        return redirect(route('admin.role.index'));
    }
}
