<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {
    public function mail() {
        $user_details = [
            'name' => 'RH Rony',
            'contact' => '01839096877',
            'password' => '12345678',
            'email' => 'rhrony0009@gmail.com'
        ];
        Mail::to($user_details['email'])->queue(new UserRegistration($user_details));

        // return redirect()->route('home');
    }
}
