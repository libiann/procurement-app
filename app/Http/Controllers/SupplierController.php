<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.list', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_name' => 'required|string|max:255',
            'address' => 'required',
            'tax_no' => 'required',
            'country' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supplier = new Supplier();
        $supplier->supplier_name = $request->input('supplier_name');
        $supplier->address = $request->input('address');
        $supplier->tax_no = $request->input('tax_no');
        $supplier->country = $request->input('country');
        $supplier->mobile = $request->input('mobile');
        $supplier->email = $request->input('email');
        $supplier->status = 'Active';
        $supplier->save();

        return redirect('/suppliers')->with('status', 'Supplier added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'supplier_name' => 'required|string|max:255',
            'address' => 'required',
            'tax_no' => 'required',
            'country' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supplier->supplier_name = $request->input('supplier_name');
        $supplier->address = $request->input('address');
        $supplier->tax_no = $request->input('tax_no');
        $supplier->country = $request->input('country');
        $supplier->mobile = $request->input('mobile');
        $supplier->email = $request->input('email');
        $supplier->status = $request->input('status');
        $supplier->update();

        return redirect('/suppliers')->with('status', 'Supplier updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect('/suppliers')->with('status', 'Supplier deleted successfully!');
    }
}
