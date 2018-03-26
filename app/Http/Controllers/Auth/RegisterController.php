<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\University;
use Mail;
use Nexmo;
use Socialite;
use App\SocialProvider;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function Validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mobile_number' => 'required|max:18',
            'university' => 'required|max:255',
            'nim' => 'required|max:255',
            'major' => 'required|max:255',
            'faculty' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
    }

    protected function create(array $data)
    {
        $university = University::orderBy('name')->get();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'password' => bcrypt($data['password']),
            'university' => $data['university'],
            'nim' => $data['nim'],
            'major' => $data['major'],
            'faculty' => $data['faculty'],
            'address' => $data['address'],
        ]);
    }
    
    protected function register(Request $request)
    {
        $input = $request->all();

        $Validator = $this->Validator($input);

        if ($Validator->passes()) {
            DB::beginTransaction();
            try {
                $data =$this->create($input)->toArray();

                $data['token'] = str_random(25);

                $user = User::find($data['id']);

                $user->token= $data['token'];

                $user->save();
                DB::commit();
                
                Mail::send('mails.confirmation' ,$data ,function($message) use($data){
                    $message->to($data['email']);
                    $message->subject('Registration Confimation');
                });
                $prefix=substr($input['mobile_number'], 0,2);
                $msisdn=$input['mobile_number'];
                if ($prefix!='62'){
                    if (substr($prefix, 0,1)=='0'){
                        $msisdn='62'.substr($input['mobile_number'], 1);
                    }else{
                        $msisdn='62'.$input['mobile_number'];
                    }
                }
                $message=trans('register.message_verification',['verify_code'=>'373474']);
                Nexmo::message()->send([
                    'to' => $msisdn,
                    'from' => 'TELKOM DDS',
                    'text' => $message
                ]);
                DB::commit();
                return redirect(route('login-register'))->with('status', 'confirmation email has been send ,please check your email.');
            } catch (\Exception $e) {
                DB::rollback();
            }
             
        }

        $register = true;
        $login = false;
        $forgot = false;
        return back()->with('register','login','forgot')->withErrors($Validator)->withInput();
    }

    public function confirmation($token){
        $user = User::where('token', $token)->first();

        if (!is_null($user)) {
            $user->confirmed = true;
            $user->token = null;
            $user->save();
            return redirect(route('login-register'))->with('status', 'Your Activation is complete'); 
        }

        return redirect(route('login-register'))->with('status', trans('register.confirmation_status'));
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try
        {
            $socialuser = Socialite::driver($provider)->user();
        }
        catch(\exception $e)
        {
            return redirect('/');
        }
        $SocialProvider = SocialProvider::where('provider_id', $socialuser->getId())->first();
        if (!$SocialProvider) {
            $user = User::firstOrCreate(
                ['email' => $socialuser->getEmail()],
                ['name' => $socialuser->getName()]
            );
            $user->socialProviders()->create(
                ['provider_id' => $socialuser->getId(), 'provider' => $provider]
                );
        }
        else{
            $user = $SocialProvider->user;
        }
        auth()->login($user);
        return redirect('/home');

        // $user->token;
    }
}
