<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.list', compact('items'));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        return view('items.add', compact('suppliers'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'inventory_location' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'supplier_id' => 'required',
            'stock_unit' => 'required',
            'unit_price' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $item = new Item();
        $item->item_name = $request->input('item_name');
        $item->inventory_location = $request->input('inventory_location');
        $item->brand = $request->input('brand');
        $item->category = $request->input('category');
        $item->supplier_id = $request->input('supplier_id');
        $item->stock_unit = $request->input('stock_unit');
        $item->unit_price = $request->input('unit_price');
        $item->status = 'Enabled';
        $item->save();

        $images = [];
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $images[] = [
                'item_id' => $item->id,
                'image' => $imageName,
            ];
        }
        foreach ($images as $imageData) {
            ItemImage::create($imageData);
        }

        return redirect('/items')->with('status', 'Item added successfully!');
    }

    public function edit(Item $item)
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        $images = ItemImage::where('item_id', $item->id)->get();
        return view('items.edit', compact('images', 'item', 'suppliers'));
    }

    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'inventory_location' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'supplier_id' => 'required',
            'stock_unit' => 'required',
            'unit_price' => 'required',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $item->item_name = $request->input('item_name');
        $item->inventory_location = $request->input('inventory_location');
        $item->brand = $request->input('brand');
        $item->category = $request->input('category');
        $item->supplier_id = $request->input('supplier_id');
        $item->stock_unit = $request->input('stock_unit');
        $item->unit_price = $request->input('unit_price');
        $item->status = $request->input('status');
        $item->save();

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $deleteImageId) {
                $image = ItemImage::find($deleteImageId);
                if ($image) {
                    $filePath = public_path('images/' . $image->image);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $image->delete();
                }
            }
        }

        if ($request->has('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $images[] = [
                    'item_id' => $item->id,
                    'image' => $imageName,
                ];
            }
            foreach ($images as $imageData) {
                ItemImage::create($imageData);
            }
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $images = ItemImage::where('item_id', $item->id)->get();
        if ($images) {
            foreach ($images as $image) {
                $filePath = public_path('images/' . $image->image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete();
            }
        }
        $item->delete();
        return redirect('/items')->with('status', 'Item deleted successfully!');
    }
}
