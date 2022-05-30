<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Nette\Schema\Expect;

class ExpenseController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function expense(Request $request) {
        if ($request->filter == '7days') {
            $expenses = Expense::where('created_at', '>=', Carbon::now()->subDays(7))->latest()->get();
            $page_title = 'Expenses added in the last 7 days';
        } elseif ($request->filter == '30days') {
            $expenses = Expense::where('created_at', '>=', Carbon::now()->subDays(30))->latest()->get();
            $page_title = 'Expenses added in the last 30 days';
        } elseif ($request->filter == 'thismonth') {
            $expenses = Expense::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->latest()->get();
            $page_title = 'Expenses added in this month';
        } elseif ($request->filter == 'lastmonth') {
            $expenses = Expense::whereMonth('created_at', Carbon::now()->subMonth(1))->whereYear('created_at', date('Y'))->latest()->get();
            $page_title = 'Expenses added in last month';
        } elseif ($request->filter == 'thisyear') {
            $expenses = Expense::whereYear('created_at', date('Y'))->latest()->get();
            $page_title = 'Expenses added in this year';
        } elseif ($request->filter == 'lastyear') {
            $expenses = Expense::whereYear('created_at', Carbon::now()->subYear(1))->latest()->get();
            $page_title = 'Expenses added in last year';
        } else {
            $expenses = Expense::latest()->get();
            $page_title = 'Expenses List';
        }

        return view('admin.expense.expense', [
            'page_title' => $page_title,
            'expenses' => $expenses,
            'filter' => $request->filter ?? '',
        ]);
    }

    public function expense_add() {
        return view('admin.expense.expense_add', [
            'page_title' => 'Add Expense',
            'members' => User::orderBy('name')->get(),
        ]);
    }

    public function expense_store(Request $request) {
        $request->validate([
            'details' => 'required',
            'amount' => 'required',
        ]);

        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'user_id' => $request->member,
            'created_at' => now(),
        ]);

        return redirect()->route('expense')->with('success', 'Expense added successfully');
    }

    public function expense_edit($id) {
        return view('admin.expense.expense_edit', [
            'page_title' => 'Edit Expense',
            'expense' => Expense::find($id),
            'members' => User::orderBy('name')->get(),
        ]);
    }

    public function expense_update(Request $request) {
        $request->validate([
            'id' => 'required',
            'details' => 'required',
            'amount' => 'required',
        ]);

        Expense::find($request->id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'user_id' => $request->member,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Expense updated successfully');
    }

    public function expense_delete($id) {
        if (Expense::where('id', $id)->doesntExist()) {
            return redirect()->route('expense')->with('error', 'Oppsss. No Expense found.');
        }
        Expense::find($id)->delete();
        return back()->with('success', 'Expense deleted successfully');
    }
}
