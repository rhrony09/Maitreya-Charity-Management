<?php

namespace App\Http\Controllers;

use App\Models\Funds;
use App\Models\Month;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function funds(Request $request) {
        if ($request->year && Funds::where('year', $request->year)->doesntExist()) {
            return redirect()->route('funds')->with('error', 'No Funds found for this year');
        }
        return view('admin.funds.funds', [
            'page_title' => 'Funds',
            'months' => Month::all(),
            'year' => $request->year ?? date('Y'),
            'year_list' => Funds::select('year')->distinct()->get()->sortBy('year')->pluck('year')->toArray(),
            'members' => User::where('status', 1)->get()->sortBy('name'),
        ]);
    }

    public function funds_list(Request $request) {
        if ($request->filter == '7days') {
            $funds = Funds::where('created_at', '>=', Carbon::now()->subDays(7))->latest()->get();
            $page_title = 'Funds added in the last 7 days';
        } elseif ($request->filter == '30days') {
            $funds = Funds::where('created_at', '>=', Carbon::now()->subDays(30))->latest()->get();
            $page_title = 'Funds added in the last 30 days';
        } elseif ($request->filter == 'thismonth') {
            $funds = Funds::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->latest()->get();
            $page_title = 'Funds added in this month';
        } elseif ($request->filter == 'lastmonth') {
            $funds = Funds::whereMonth('created_at', Carbon::now()->subMonth(1))->whereYear('created_at', date('Y'))->latest()->get();
            $page_title = 'Funds added in last month';
        } elseif ($request->filter == 'thisyear') {
            $funds = Funds::whereYear('created_at', date('Y'))->latest()->get();
            $page_title = 'Funds added in this year';
        } elseif ($request->filter == 'lastyear') {
            $funds = Funds::whereYear('created_at', Carbon::now()->subYear(1))->latest()->get();
            $page_title = 'Funds added in last year';
        } else {
            $funds = Funds::latest()->get();
            $page_title = 'Funds List';
        }

        return view('admin.funds.list', [
            'page_title' => $page_title,
            'funds' => $funds,
            'filter' => $request->filter ?? '',
        ]);
    }

    public function funds_view_member($id, Request $request) {
        $user = User::find($id);
        if (User::where('id', $id)->doesntExist() || ($request->year && Funds::where('user_id', $id)->where('year', $request->year)->doesntExist())) {
            return redirect()->route('funds')->with('error', 'Oppsss. No Funds found.');
        }
        return view('admin.funds.funds_view_member', [
            'page_title' => 'Funds of ' . $user->name,
            'months' => Month::all(),
            'year' => $request->year ?? date('Y'),
            'year_list' => Funds::where('user_id', $id)->select('year')->distinct()->get()->sortBy('year')->pluck('year')->toArray(),
            'user' => $user,
        ]);
    }

    public function funds_view_personal(Request $request) {
        $user = User::find(Auth::id());
        return view('admin.funds.funds_view_member', [
            'page_title' => 'Funds of ' . $user->name,
            'months' => Month::all(),
            'year' => $request->year ?? date('Y'),
            'year_list' => Funds::where('user_id', Auth::id())->select('year')->distinct()->get()->sortBy('year')->pluck('year')->toArray(),
            'user' => $user,
        ]);
    }

    public function funds_view_details($id) {
        echo view('admin.modals.fund_details', [
            'fund' => Funds::find($id),
        ]);
    }

    public function funds_add() {
        return view('admin.funds.funds_add', [
            'page_title' => 'Add Funds',
            'months' => Month::all(),
            'members' => User::where('status', 1)->get()->sortBy('name'),
            'payment_methods' => PaymentMethod::all(),
        ]);
    }

    public function funds_store(Request $request) {
        if (Auth::user()->role > 3) {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
        $request->validate([
            'type' => 'required',
            'member' => 'required',
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required|numeric',
        ]);

        if (
            $request->type == 1 && Funds::where('user_id', $request->member)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->exists()
        ) {
            return redirect()->back()->withInput()->withErrors(['month' => 'Funds already exists for this month.']);
            die();
        }
        Funds::insert([
            'type' => $request->type,
            'user_id' => $request->member,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'created_at' => now(),
        ]);
        return redirect()->route('funds')->with('success', 'Funds added successfully');
    }

    public function funds_edit($id) {
        if (Auth::user()->role > 3) {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
        $fund = Funds::find($id);
        if (Funds::where('id', $id)->doesntExist()) {
            return redirect()->route('funds')->with('error', 'Oppsss. No Funds found.');
        }
        return view('admin.funds.funds_edit', [
            'page_title' => 'Edit Funds',
            'months' => Month::all(),
            'members' => User::where('status', 1)->get()->sortBy('name'),
            'payment_methods' => PaymentMethod::all(),
            'fund' => $fund,
        ]);
    }

    public function funds_update(Request $request) {
        if (Auth::user()->role > 3) {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
        $request->validate([
            'type' => 'required',
            'member' => 'required',
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required|numeric',
        ]);

        Funds::find($request->id)->update([
            'type' => $request->type,
            'user_id' => $request->member,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Funds updated successfully');
    }

    public function funds_delete($id) {
        if (Auth::user()->role > 3) {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
        if (Funds::where('id', $id)->doesntExist()) {
            return redirect()->route('funds')->with('error', 'Oppsss. No Funds found.');
        }
        Funds::find($id)->delete();
        return back()->with('success', 'Funds deleted successfully');
    }
}
