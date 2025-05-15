<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Transaction::with('member');

        // Terapkan filter jika ada
        if ($this->request->status) {
            $query->where('status', $this->request->status);
        }

        if ($this->request->start_date) {
            $query->whereDate('created_at', '>=', $this->request->start_date);
        }

        if ($this->request->end_date) {
            $query->whereDate('created_at', '<=', $this->request->end_date);
        }

        return view('admin.transactions.excel', [
            'transactions' => $query->get()
        ]);
    }
}
