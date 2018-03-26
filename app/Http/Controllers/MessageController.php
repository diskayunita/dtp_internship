<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Input;
use Validator;
use Redirect;
use Session;
use App\Message;
use App\User;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $data = $request->all();
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'g-recaptcha-response' => 'required|captcha|min:1',
            'message' => 'required',
        );

        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            flash('Unable to sent message, Please try again.', 'error');
            return redirect(route('message'))->withInput()->withErrors($validator);
        } else {
            $message = Message::create([ 
            	'user_id' => Auth::user()->id,
            	'message' => $data['message'], 
            	'name' => $data['name'], 
            	'subject' => $data['subject'], 
            	'email' => $data['email']]);
            
            flash('message has ben sent successfully', 'success');
            return redirect(route('message'));
        }
    }
}
