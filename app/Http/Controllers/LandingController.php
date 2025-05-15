<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $items = Item::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%")
                ->orWhere('keyword', 'like', "%$keyword%");
        })->latest()->take(6)->get();

        return view('welcome', compact('items'));
    }
}
