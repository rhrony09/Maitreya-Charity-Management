<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Contact;
use App\Models\Expense;
use App\Models\Funds;
use App\Models\Gallery;
use App\Models\Log;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class HomeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (Auth::user()->status == 1) {
            return view('home', [
                'page_title' => 'Welcome to Maitreya',
                'funds' => Funds::all(),
                'expenses' => Expense::all(),
            ]);
        } else {
            return view('home_inactive', [
                'page_title' => 'Welcome to Maitreya',
            ]);
        }
    }

    public function settings() {
        if (Auth::user()->role <= 2) {
            $settings = [];
            foreach (Setting::all() as $setting) {
                $settings[$setting->type] = $setting->name;
            }
            $settings = json_decode(json_encode($settings), false);

            return view('admin.settings', [
                'page_title' => 'Settings',
                'settings' => $settings,
            ]);
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
    }

    public function settings_update(Request $request) {
        if (Auth::user()->role <= 2) {
            $request->validate([
                'title' => 'required',
                'tagline' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'logo' => 'mimes:png',
                'logo_black' => 'mimes:png',
                'favicon' => 'mimes:png',
            ]);

            Setting::where('type', 'title')->update(['name' => $request->title]);
            Setting::where('type', 'tagline')->update(['name' => $request->tagline]);
            Setting::where('type', 'contact')->update(['name' => $request->contact]);
            Setting::where('type', 'email')->update(['name' => $request->email]);

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                if (Setting::where('type', 'logo')->first()->name != 'logo.png') {
                    unlink(public_path('uploads/logo/' . Setting::where('type', 'logo')->first()->name));
                }
                $logo_name = 'logo-' . time() . '.' . $logo->getClientOriginalExtension();
                Image::make($logo)->save(public_path('uploads/logo/' . $logo_name));
                Setting::where('type', 'logo')->update(['name' => $logo_name]);
            }

            if ($request->hasFile('logo_black')) {
                $logo_black = $request->file('logo_black');
                if (Setting::where('type', 'logo_black')->first()->name != 'logo-black.png') {
                    unlink(public_path('uploads/logo/' . Setting::where('type', 'logo_black')->first()->name));
                }
                $logo_black_name = 'logo-black-' . time() . '.' . $logo_black->getClientOriginalExtension();
                Image::make($logo_black)->save(public_path('uploads/logo/' . $logo_black_name));
                Setting::where('type', 'logo_black')->update(['name' => $logo_black_name]);
            }

            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                if (Setting::where('type', 'favicon')->first()->name != 'favicon.png') {
                    unlink(public_path('uploads/logo/' . Setting::where('type', 'favicon')->first()->name));
                }
                $favicon_name = 'favicon-' . time() . '.' . $favicon->getClientOriginalExtension();
                Image::make($favicon)->fit(50)->save(public_path('uploads/logo/' . $favicon_name));
                Setting::where('type', 'favicon')->update(['name' => $favicon_name]);
            }

            return back()->with('success', 'Settings updated successfully');
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to perform this action.');
        }
    }

    public function site_banner() {
        return view('admin.frontend.banner', [
            'page_title' => 'Banner',
            'banners' => Banner::all(),
        ]);
    }

    public function site_banner_store(Request $request) {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $banner_name = 'banner-' . time() . '.jpg';
        Image::make($request->image)->fit(1920, 900)->save(public_path('uploads/banner/' . $banner_name));
        Banner::insert([
            'image' => $banner_name,
            'created_at' => now(),
        ]);
        return back()->with('success', 'Banner added successfully');
    }

    public function site_banner_status($id) {
        $count = Banner::where('status', 1)->count();
        $banner = Banner::find($id);
        if ($banner->status == 1) {
            if ($count <= 2) {
                return back()->with('error', 'Minimum 2 banner required.');
            } else {
                $banner->update([
                    'status' => 0,
                ]);
                return back()->with('success', 'Banner status updated successfully');
            }
        } else {
            if ($count == 4) {
                return back()->with('error', 'Maximum activation limit reached.');
            } else {
                $banner->update([
                    'status' => 1,
                ]);
                return back()->with('success', 'Banner status updated successfully');
            }
        }
    }

    public function site_banner_delete($id) {
        $banner = Banner::find($id);
        if ($banner->status == 1) {
            return back()->with('error', 'Banner is active. Please deactivate first.');
        } else {
            unlink(public_path('uploads/banner/' . $banner->image));
            $banner->delete();
            return back()->with('success', 'Banner deleted successfully');
        }
    }

    public function site_gallery() {
        return view('admin.frontend.gallery', [
            'page_title' => 'Gallery',
            'galleries' => Gallery::orderByDesc('id')->get(),
        ]);
    }

    public function site_gallery_store(Request $request) {
        foreach ($request->image as $image) {
            $gallery_name = 'gallery-' . uniqid() . '.jpg';
            Image::make($image)->fit(900, 600)->save(public_path('uploads/gallery/' . $gallery_name));
            Gallery::insert([
                'image' => $gallery_name,
                'created_at' => now(),
            ]);
        }
        return back()->with('success', 'Gallery image added successfully');
    }

    public function site_gallery_delete($id) {
        $gallery = Gallery::find($id);
        unlink(public_path('uploads/gallery/' . $gallery->image));
        $gallery->delete();
        return back()->with('success', 'Gallery image deleted successfully');
    }

    public function messages() {
        return view('admin.frontend.message', [
            'page_title' => 'Messages',
            'messages' => Contact::latest()->paginate(30),
        ]);
    }

    public function messages_view($id) {
        $message = Contact::find($id);
        if ($message->status == 1) {
            $message->update([
                'status' => 2,
            ]);
        }
        return view('admin.frontend.message_view', [
            'page_title' => 'Message',
            'message' => $message,
        ]);
    }

    public function messages_delete($id) {
        $message = Contact::find($id);
        $message->delete();
        return redirect()->route('site.messages')->with('success', 'Message deleted successfully');
    }

    public function logs() {
        return view('admin.logs', [
            'page_title' => 'Logs',
            'logs' => Log::latest()->get(),
        ]);
    }

    public function debug() {
        send_sms('01839096877', 'টেস্ট সম্পাদনা করা হয়েছে');
    }
}
