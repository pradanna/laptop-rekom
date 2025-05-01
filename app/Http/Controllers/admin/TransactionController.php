<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('admin.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::where('role', 'pembeli')->get();
        return view('admin.transaction.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|integer',
            'status' => 'required|in:baru,diproses,selesai',
        ]);

        Transaction::create($request->all());
        return redirect()->route('admin.transaction.index')->with('success', 'Transaction created!');
    }

    public function edit(Transaction $transaction)
    {
        $users = User::where('role', 'pembeli')->get();
        return view('admin.transaction.edit', compact('transaction', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|integer',
            'status' => 'required|in:baru,diproses,selesai',
        ]);

        $transaction->update($request->all());
        return redirect()->route('admin.transaction.index')->with('success', 'Transaction updated!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return back()->with('success', 'Transaction deleted!');
    }
}
