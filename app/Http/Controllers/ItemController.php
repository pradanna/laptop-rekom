<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('detail', compact('item'));
    }

    public function searchAjax(Request $request)
    {
        $keyword = $request->keyword;
        if (!$keyword) {
            $items = Item::where('isSold', false)->get(); // default tampilkan semua
        } else {
            $items = Item::searchContentBased($keyword); // panggil dari model
        }

        return view('partials.search_results', compact('items'))->render();
    }
}
