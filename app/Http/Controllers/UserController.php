<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avatar;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function profile()
    {
        $user = Auth::user();
        $avatar = Avatar::find($user->id);
        $user->avatar = $avatar->avatar;
        return view('user.profile', compact('user'));
    }
  
    public function updateProfile(Request $request)
    {
        $input = $request->all();
    
        $avatar = Avatar::find(Auth::user()->id);
    
        $avatar->update([
            'avatar' => isset($input['avatar']) ? $input['avatar'] : '' , 
            'name' => $input['name'], 
            'mobile_number' => $input['mobile_number'],
            'address' => $input['address'],
            'university' => $input['university'],
            'nim' => $input['nim'],
            'major' => $input['major'],
            'faculty' => $input['faculty'],
        ]);
        
        if ($avatar) {
            flash('profile has been updated successfully', 'success');
        } else {
            flash('profile update failed', 'error');
        }
    
        return redirect(route('user.profile'));
    }
}
