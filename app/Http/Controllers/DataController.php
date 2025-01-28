<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function overview() {
        $items = Item::with('storage')->get();
        return view('overview', [
             'title' => 'Overview Page',
             'items' => $items
        ]);
    }

    public function dashboard() {
        $items = Item::with('storage')->get();
        return view('dashboard', [ 
            'title' => 'Dashboard Page',
            'items' => $items
        ]);
    }

    public function addData() {
        $warehouses = \App\Models\Storage::all('id', 'name');
        return view('forms.add', [
            'title' => 'Add Data Page',
            'warehouses' => $warehouses
        ]);
    }

    public function editData($id) {
        $item = Item::find($id);
        $warehouses = \App\Models\Storage::all('id', 'name');
        return view('forms.edit', [
            'title' => 'Edit Data Page',
            'item' => $item,
            'warehouses' => $warehouses
        ]);
    }

    public function deleteData($id) 
    {
        $item = Item::find($id); 
        Storage::disk('public')->delete('item-images/' . $item->image);
        $item->delete();
        return redirect()->back();
    }

    public function sendData(Request $request)
    {
        $request->validate([
            'storage_id' => 'required|exists:storages,id',
            'name' => 'required|string',
            'code' => 'required|unique:items',
            'category' => 'required|in:food,drink,clothes,other',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:5048',
            'description' => 'required|string|max:155'
        ]);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imagePath = $image->store('item-images', 'public');
            $imagePath = basename($imagePath);    
        }
        // dd($imagePath);

        Item::create([
            'storage_id' => $request->storage_id,
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'image' => $imagePath,
            'description' => $request->description
        ]);

        return redirect()->route('dashboard')->with('success', 'Data berhasil ditambahkan!');
    }

    public function updateData(Request $request, $id)
    {
        $item = Item::find($id);
        $request->validate([
            'storage_id' => 'required|exists:storages,id',
            'name' => 'required|string',
            'code' => 'required|unique:items,code,' . $item->id,
            'category' => 'required|in:food,drink,clothes,other',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:5048',
            'description' => 'required|string|max:155'
        ]);

        $imagePath = $item->image;
        if($request->hasFile('image'))
        {
            Storage::disk('public')->delete('item-images/' . $item->image);
            $image = $request->file('image');
            $imagePath = $image->store('item-images', 'public');
            $imagePath = basename($imagePath);    
        }

        $item->update([
            'storage_id' => $request->storage_id,
            'name' => $request->name,
            'code' => $request->code,
            'category' => $request->category,
            'image' => $imagePath,
            'description' => $request->description
        ]);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui!');
    }

}
