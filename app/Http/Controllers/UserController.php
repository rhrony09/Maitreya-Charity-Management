<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistration;
use App\Models\Funds;
use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    //show user list
    public function users(Request $request) {
        if (Auth::user()->role <= 2) {
            if ($request->status == 'active') {
                $users = User::where('status', 1)->get();
                $page_title = 'Active Members';
            } elseif ($request->status == 'inactive') {
                $users = User::where('status', 0)->latest()->get();
                $page_title = 'Inactive Members';
            } else {
                $users = User::all();
                $page_title = 'All Members';
            }

            return view('admin.users.index', [
                'page_title' => $page_title,
                'users' => $users,
                'roles' => Role::all(),
                'status' => $request->status ?? '',
            ]);
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
    }

    //show trashed user list
    public function users_trashed() {
        if (Auth::user()->role <= 2) {
            $users = User::onlyTrashed()->get();
            return view('admin.users.trashed', [
                'page_title' => 'Deleted Users',
                'users' => $users,
            ]);
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
    }

    //add new user
    public function user_create() {
        if (Auth::user()->role <= 2) {
            return view('admin.users.create', [
                'page_title' => 'Add New User',
                'roles' => Role::all()
            ]);
        } else {
            return redirect()->route('users')->with('error', 'You are not authorized to access this page.');
        }
    }

    //store new user
    public function user_store(Request $request) {
        if (Auth::user()->role <= 2) {
            $request->validate([
                'name' => 'required|string|max:255',
                'contact' => 'required|numeric|digits_between:11,16|unique:users',
                'password' => 'required|string|min:8',
                'image' => 'mimes:jpeg,png,jpg',
            ], [
                'contact.unique' => 'This mobile number is already registered.',
                'contact.required' => 'Please enter your mobile number.',
                'contact.numeric' => 'Please enter a valid mobile number.',
                'contact.digits_between' => 'Please enter 11 digit mobile number.',
            ]);

            $id = User::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'type' => $request->type,
                'password' => bcrypt($request->password),
                'status' => 1,
                'role' => $request->role ?? 4,
                'created_at' => Carbon::now()
            ]);

            if ($request->hasFile('image')) {
                $image = $request->image;
                $file_name = Str::lower(Str::replace(' ', '-', $request->name)) . '-' . $id . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(200, 200)->save(public_path('/uploads/users/' . $file_name));
                User::find($id)->update([
                    'image' => $file_name
                ]);
            }

            if ($request->email != null) {
                $user_details = [
                    'name' => $request->name,
                    'contact' => $request->contact,
                    'password' => $request->password,
                ];
                if (Mail::to($request->email)->queue(new UserRegistration($user_details))) {
                    rh_log($request->email, 'Member Add Email', 'Sent');
                } else {
                    rh_log($request->email, 'Member Add Email', 'Failed');
                }
            }

            $message = 'আমাদের সাথে স্বেচ্ছাসেবী হিসাবে যোগদানের জন্য ধন্যবাদ।

টিম মৈত্রেয়';
            if (send_sms($request->contact, $message)) {
                rh_log($request->contact, 'Member Add SMS', 'Sent');
            } else {
                rh_log($request->contact, 'Member Add SMS', 'Failed');
            }

            return redirect()->route('users')->with('success', 'User Added Successfully');
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to perform this action');
        }
    }

    //shoe single user
    public function users_view($id) {
        $user = User::find($id);
        if (User::where('id', $id)->doesntExist()) {
            return redirect()->route('users')->with('error', 'Oppsss. No Member found.');
        }
        return view('admin.users.user', [
            'page_title' => 'User Profile',
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    //update user info
    public function users_update_info(Request $request) {
        $user = User::find($request->id);

        if (Auth::user()->role <= $user->role && Auth::user()->role <= 2) {
            $request->validate([
                'name' => 'required|string|max:255',
                'contact' => 'required|numeric|digits_between:11,11|unique:users,contact,' . $user->id,
                'image' => 'mimes:jpeg,png,jpg',
                'role' => 'required',
                'email' => 'email|unique:users,email,' . $user->id,
            ], [
                'contact.unique' => 'This mobile number is already registered.',
                'contact.required' => 'Please enter your mobile number.',
                'contact.numeric' => 'Please enter a valid mobile number.',
                'contact.digits_between' => 'Please enter 11 digit mobile number.',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'role' => $request->role,
                'type' => $request->type,
            ]);
            return back()->with('success', 'User updated successfully');
        } else {
            return back()->with('error', 'You are not authorized to perform this action.');
        }
    }

    //update user password
    public function users_update_password(Request $request) {
        $user = User::find($request->id);
        if (Auth::user()->role <= $user->role && Auth::user()->role <= 2) {
            $request->validate([
                'password' => 'required|min:8',
                'confirm_password' => 'same:password'
            ]);
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return back()->with('success', 'Password updated successfully');
        } else {
            return back()->with('error', 'You are not authorized to perform this action.');
        }
    }

    //edit user profile photo
    public function users_update_profile_pic(Request $request) {
        $user = User::find($request->id);

        if (Auth::user()->role <= $user->role && Auth::user()->role <= 2) {
            $request->validate([
                'image' => 'required|mimes:jpeg,jpg,png',
            ]);

            if ($user->image != 'default.jpg') {
                unlink(public_path('uploads/users/' . $user->image));
            }

            $image = $request->image;
            $file_name = Str::lower(Str::replace(' ', '-', $user->name)) . '-' . $user->id . '.' . $image->getClientOriginalExtension();

            Image::make($image)->fit(200, 200)->save(public_path('uploads/users/' . $file_name));
            $user->update([
                'image' => $file_name
            ]);
            return back()->with('success', 'User updated successfully');
        } else {
            return back()->with('error', 'You are not authorized to perform this action.');
        }
    }

    //update user role from user list
    public function users_update_role(Request $request) {
        $user = User::find($request->id);
        if (Auth::user()->role <= $user->role && Auth::user()->role <= 2) {
            $edit = $user->update([
                'role' => $request->role
            ]);
            if ($edit) {
                $response = ['status' => 'success', 'message' => 'User role updated successfully.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Something went wrong.'];
            }
        } else {
            $response = ['sataus' => 'error', 'message' => 'You can not change role of this user.'];
        }
        return response()->json($response);
    }

    //update user status from user list
    public function users_update_status(Request $request) {
        $user = User::find($request->id);
        if (Auth::user()->role <= 2 && Auth::id() != $request->id) {
            $edit = $user->update([
                'status' => $request->status
            ]);
            if ($edit) {
                if ($request->status == 1) {
                    $message = 'আপনার একাউন্টটি সচল করা হয়েছে।

টিম মৈত্রেয়';
                    if (send_sms($user->contact, $message)) {
                        rh_log($user->contact, 'Account Active SMS', 'Sent');
                    } else {
                        rh_log($user->contact, 'Account Active SMS', 'Failed');
                    }
                }
                $response = ['status' => 'success', 'message' => 'User status updated successfully.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Something went wrong.'];
            }
        } else {
            $response = ['sataus' => 'error', 'message' => 'You can not change status of this user.'];
        }
        return response()->json($response);
    }

    //delete user
    public function users_delete($id) {
        $user = User::find($id);
        if (Funds::where('user_id', $id)->exists()) {
            return back()->with('error', 'You can not delete this member.');
        } else {
            if (Auth::user()->role <= $user->role && Auth::user()->role <= 2 && $user->id != Auth::user()->id) {
                if ($user->delete()) {
                    return back()->with('success', 'Member deleted successfully.');
                } else {
                    return back()->with('error', 'Something went wrong.');
                }
            } else {
                return back()->with('error', 'You are not authorized to perform this action.');
            }
        }
    }

    //permanently delete user
    public function users_delete_permanent($id) {
        $user = User::onlyTrashed()->find($id);
        if (Auth::user()->role <= 2) {
            if ($user->image != 'default.jpg') {
                unlink(public_path('uploads/users/' . $user->image));
            }
            if ($user->forceDelete()) {
                return back()->with('success', 'Member permanently deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong.');
            }
        } else {
            return back()->with('error', 'You are not authorized to perform this action.');
        }
    }

    //deleted user restore
    public function users_restore($id) {
        $user = User::onlyTrashed()->find($id);
        if (Auth::user()->role <= 2) {
            if ($user->restore()) {
                return back()->with('success', 'Member restored successfully.');
            } else {
                return back()->with('error', 'Something went wrong.');
            }
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to perform this action.');
        }
    }

    //user profile
    public function profile() {
        return view('admin.users.profile', [
            'page_title' => 'User Profile',
        ]);
    }

    //user profile info update
    public function profile_update_info(Request $request) {
        $user = User::find(Auth::id());
        if ($request->has('name')) {
            $request->validate([
                'name' => 'required',
                'contact' => 'required|numeric|digits_between:11,11|unique:users,contact,' . $user->id,
            ], [
                'contact.unique' => 'This mobile number is already registered.',
                'contact.required' => 'Please enter your mobile number.',
                'contact.numeric' => 'Please enter a valid mobile number.',
                'contact.digits_between' => 'Please enter 11 digit mobile number.',
            ]);

            $user->update([
                'name' => $request->name,
                'contact' => $request->contact,
            ]);
            return back()->with('success', 'Profile updated successfully');
        } elseif ($request->has('password')) {
            $request->validate([
                'password' => 'min:8',
                'confirm_password' => 'same:password'
            ]);
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return back()->with('success', 'Password updated successfully');
        }
    }

    //user profile photo update
    public function profile_update_profile_pic(Request $request) {
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $user = User::find(Auth::id());
        if ($user->image != 'default.jpg') {
            unlink(public_path('uploads/users/' . $user->image));
        }

        $image = $request->image;
        $file_name = Str::lower(Str::replace(' ', '-', $user->name)) . '-' . $user->id . '.' . $image->getClientOriginalExtension();

        Image::make($image)->fit(200, 200)->save(public_path('uploads/users/' . $file_name));
        $user->update([
            'image' => $file_name
        ]);
        return back()->with('success', 'User updated successfully');
    }

    //user role tist
    public function role() {
        if (Auth::user()->role == 1) {
            $roles = Role::all();
            return view('admin.users.role.index', [
                'roles' => $roles,
                'page_title' => 'Roles',
            ]);
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
    }

    //add new role
    public function role_add(Request $request) {
        if (Role::where('role', $request->role)->exists()) {
            $response = ['status' => 'error', 'message' => 'Role already exist.'];
        } else {
            $store = Role::insert([
                'role' => $request->role,
                'created_at' => Carbon::now(),
            ]);
            if ($store) {
                $response = ['status' => 'success', 'message' => 'Role added successfully.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Something went wrong.'];
            }
        }
        echo json_encode($response);
    }

    //get role data
    public function role_edit_data(Request $request) {
        $role = Role::find($request->id);
        echo json_encode($role);
    }

    //update role
    public function role_edit(Request $request) {
        $edit = Role::find($request->id)->update([
            'role' => $request->role
        ]);
        if ($edit) {
            $response = ['status' => 'success', 'message' => 'Role edited successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong.'];
        }
        echo json_encode($response);
    }

    //delete role
    public function role_delete($id) {
        if (User::where('role', $id)->exists() || $id == 1 || $id == 2) {
            return back()->with('error', 'Unable to delete this category.');
        } else {
            $role = Role::find($id);
            if (Auth::user()->role == 1) {
                if ($role->delete()) {
                    return back()->with('success', 'User deleted successfully.');
                } else {
                    return back()->with('error', 'Something went wrong.');
                }
            } else {
                return back()->with('error', 'You are not authorized to perform this action.');
            }
        }
    }
}
