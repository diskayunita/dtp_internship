<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Input;
use Validator;
use Redirect;
use Session;
use App\Contact;
use App\User;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $messages = Contact::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
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
            $contact = Contact::create([ 
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