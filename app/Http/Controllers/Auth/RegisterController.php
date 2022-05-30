<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistration;
use App\Models\Log;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'numeric', 'digits_between:11,11', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'contact.unique' => 'This mobile number is already registered.',
            'contact.required' => 'Please enter your mobile number.',
            'contact.numeric' => 'Please enter a valid mobile number.',
            'contact.digits_between' => 'Please enter 11 digit mobile number.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {
        if ($data['email']) {
            $user_details = [
                'name' => $data['name'],
                'contact' => $data['contact'],
                'password' => $data['password'],
            ];
            if (Mail::to($data['email'])->queue(new UserRegistration($user_details))) {
                rh_log($data['email'], 'Member Reg Email', 'Sent');
            } else {
                rh_log($data['email'], 'Member Reg Email', 'Failed');
            }
        }

        $message = 'আমাদের সাথে স্বেচ্ছাসেবী হিসাবে যোগদানের জন্য ধন্যবাদ।

টিম মৈত্রেয়';
        if (send_sms($data['contact'], $message)) {
            rh_log($data['contact'], 'Member Reg SMS', 'Sent');
        } else {
            rh_log($data['contact'], 'Member Reg SMS', 'Failed');
        }

        return User::create([
            'name' => $data['name'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
