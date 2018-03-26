<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

Use App\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $title = "Permission List";
        return view('admin.permission.index', compact('permissions', 'title'));
    }
  
    public function create()
    {
        $permission = new Permission();
        $title = "Permission Create";
        return view('admin.permission.create', compact('title', 'permission'));
    }
  
    public function store(Request $request)
    {
        $input= $request->all();
    
        Permission::create(['name' => $input['name'], 'display_name'  => $input['display_name'],  'description'  => $input['description']]);
    
        flash('Permission successfully created', 'success');
        return redirect(route('admin.permission.index'));
    }
  
    public function show($id)
    {
        $permission = Permission::find($id);
        $title = $permission ? $permission->name : 'Permission Details';
        return view('admin.permission.show', compact('permission', 'title'));
    }
  
    public function edit($id)
    {
        $permission = Permission::find($id);
        $title = "Permission Edit";
        return view('admin.permission.edit', compact('title', 'permission'));
    }
  
    public function update(Request $request, $id)
    {
        $input= $request->all();
    
        $permission = Permission::find($id);
    
        $permission->update(['name' => $input['name'], 'display_name'  => $input['display_name'], 'description'  => $input['description']]);
        flash('Permission successfully updated', 'success');
        return redirect(route('admin.permission.index'));
    }
  
    public function destroy($id)
    {
        $permission = Permission::find($id);
    
        if ($permission) {
            $permission->delete();
            flash('Permission successfully deleted', 'success');
        } else {
            flash('Permission unsuccessfully deleted', 'error');
        }
    
        return redirect(route('admin.permission.index'));
    }
}
