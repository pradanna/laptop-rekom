<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $items = Item::all();
        $totalItem = $items->count();
        $totalTransaksi = Transaction::count();
        $totalPembeli = User::where('role', 'pembeli')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        return view('admin.dashboard', [
            'items' => $items,
            'totalItem' => $totalItem,
            'totalTransaksi' => $totalTransaksi,
            'totalPembeli' => $totalPembeli,
            'totalAdmin' => $totalAdmin,
        ]);
    }
}
