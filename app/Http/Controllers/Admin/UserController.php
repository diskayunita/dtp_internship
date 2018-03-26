<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $title = 'User List';
        return view('admin.user.index', compact('users', 'title'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $title = "User Details";
        return view('admin.user.show', compact('user', 'title'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $title = 'Edit User';
        return view('admin.user.edit', compact('user', 'title'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user = User::findOrFail($id);

        // set new value
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->mobile_number = $input['mobile_number'];
        $user->address = $input['address'];
        $user->university = $input['university'];
        $user->nim = $input['nim'];
        $user->major = $input['major'];
        $user->faculty = $input['faculty'];
        $user->confirmed = $input['confirmed'];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'address' => 'required',
            'university' => 'required',
            'nim' => 'required',
            'major' => 'required',
            'faculty' => 'required',
            'confirmed' => 'boolean'
        ]);

        if ($user->save()) {
            $message = sprintf('%s has been updated successfully', $user->name);
            $template = 'success';
        } else {
            $message = sprintf('Whoops! Unable to update %s detail', $user->name);
            $template = 'error';
        }

        flash($message, $template);
        return redirect(route('admin.non-admin.index'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            $message = sprintf('%s has been deleted successfully from user list', $user->name);
            $template = 'success';
        } else {
            $message = sprintf('Whoops! Unable to delete %s from user list', $user->name);
            $template = 'error';
        }

        flash($message, $template);
        return redirect(route('admin.non-admin.index'));
    }
}
