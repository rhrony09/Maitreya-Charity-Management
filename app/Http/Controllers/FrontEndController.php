<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller {

    public function index() {
        return view('frontend.index', [
            'page_title' => 'Homepage',
            'banners' => Banner::where('status', 1)->inRandomOrder()->get(),
            'galleries' => Gallery::inRandomOrder()->take(6)->get(),
        ]);
    }

    public function gallery() {
        return view('frontend.gallery', [
            'page_title' => 'Gallery',
            'galleries' => Gallery::orderByDesc('id')->get(),
        ]);
    }

    public function send_message(Request $request) {
        $request->validate([
            '*' => 'required',
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        return response()->json(['success' => 'মেসেজ সফলভাবে প্রেরণ করা হয়েছে।']);
    }

    public function volunteer() {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('frontend.volunteer', [
                'page_title' => 'Volunteer',
            ]);
        }
    }
}
