<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('admin.item.index', compact('items'));
    }

    public function create()
    {
        return view('admin.item.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'processor' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'gpu' => 'nullable|string|max:255',
            'price' => 'required|integer',
            'condition' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
            'keyword' => 'nullable|string',
            'isSold' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        // Handle upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public'); // disimpan di storage/app/public/items
        }

        // Konversi checkbox isSold ke boolean
        $data['isSold'] = $request->has('isSold');


        Item::create($data);

        return redirect()->route('admin.item.index')->with('success', 'Item created successfully');
    }

    public function show(Item $item)
    {
        return view('admin.item.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('admin.item.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'processor' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'gpu' => 'nullable|string|max:255',
            'price' => 'required|integer',
            'condition' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
            'keyword' => 'nullable|string',
            'isSold' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Item::findOrFail($id);

        $data = $request->all();

        // Handle upload image baru (hapus lama jika ada)
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('items', 'public');
        } else {
            // Tetap gunakan gambar lama jika tidak upload gambar baru
            $data['image'] = $item->image;
        }

        $item->update($data);

        return redirect()->route('admin.item.index')->with('success', 'Item updated successfully');
    }


    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('admin.item.index')->with('success', 'Item deleted successfully');
    }
}
