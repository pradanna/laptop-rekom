<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan daftar item dalam keranjang
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('item')->get();
        return view('cart', compact('cartItems'));
    }

    // Tambahkan item ke keranjang
    public function store($itemId)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambahkan item ke keranjang.');
        }


        $item = Item::findOrFail($itemId);

        // Cek apakah item sudah dibeli
        if ($item->isSold) {
            return redirect()->back()->with('error', 'Item sudah terjual.');
        }

        // Cek apakah sudah ada di keranjang
        $exists = Cart::where('user_id', Auth::id())
            ->where('item_id', $itemId)
            ->first();

        if ($exists) {
            return redirect()->back()->with('info', 'Item sudah ada di keranjang.');
        }
        // Simpan ke keranjang dengan total
        $qty = 1;
        $total = $item->price * $qty;

        Cart::create([
            'user_id' => Auth::id(),
            'item_id' => $itemId,
            'qty' => $qty,
            'total' => $total,
        ]);


        return redirect()->route('cart.index')->with('success', 'Item ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function remove($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang.');
    }
}
