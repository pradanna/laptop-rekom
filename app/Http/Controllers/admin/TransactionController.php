<?php

namespace App\Http\Controllers\admin;

use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransactionImport;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['member', 'items.item']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->latest()->get();

        return view('admin.transactions.index', compact('transactions'));
    }


    public function show(Transaction $transaction)
    {
        $transaction->load('items', 'member');
        return view('admin.transactions.show', compact('transaction'));
    }


    public function updateStatus(Transaction $transaction, $status)
    {
        $transaction->status = $status;
        $transaction->save();

        // Tandai semua item sebagai terjual jika transaksi diterima
        if ($status === 'diproses') {
            foreach ($transaction->items as $transactionItem) {
                $transactionItem->item->update(['isSold' => true]);
            }
        }

        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        return Excel::download(new TransactionExport($request), 'transactions.xlsx');
    }
}
