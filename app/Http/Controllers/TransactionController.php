<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('items.item') // jika ingin detail item di show
            ->latest()
            ->get();

        return view('transactionlist', compact('transactions'));
    }

    public function create()
    {
        $carts = Cart::with('item')->where('user_id', Auth::id())->get();
        $total = $carts->sum(fn($cart) => $cart->item->price * $cart->qty);

        return view('transaction', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        // Validasi file bukti transfer
        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil semua item di keranjang milik user
        $carts = Cart::where('user_id', Auth::id())->get();
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total harga
        $total = $carts->sum(fn($cart) => $cart->item->price * $cart->qty);

        // Simpan file bukti transfer ke folder 'proofs' di storage/public
        $path = $request->file('proof')->store('proofs', 'public');

        // Buat transaksi baru
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'proof' => $path,
            'status' => 'menunggu konfirmasi pembayaran', // sesuai enum terbaru
        ]);

        // Pindahkan item dari cart ke transaction_items
        foreach ($carts as $cart) {
            $transaction->items()->create([
                'item_id' => $cart->item_id,
                'qty' => $cart->qty,
                'price' => $cart->item->price,
            ]);

            $cart->delete(); // Hapus item dari keranjang
        }

        return redirect()->route('landing')->with('success', 'Transaksi berhasil dikirim. Menunggu konfirmasi admin.');
    }


    public function buy($id)
    {
        $item = Item::findOrFail($id);

        if ($item->isSold) {
            return redirect()->back()->with('error', 'Item sudah terjual.');
        }

        // Tandai item terjual
        $item->update(['isSold' => true]);

        // Buat transaksi
        Transaction::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'status' => 'diproses',
        ]);

        return redirect()->route('transaction')->with('success', 'Pembelian berhasil. Tunggu konfirmasi admin.');
    }

    public function checkoutCart()
    {

        $carts = Cart::where('user_id', Auth::id())->get();
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        return redirect()->route('transaction.create')->with('success', 'Checkout berhasil!');
    }
}
