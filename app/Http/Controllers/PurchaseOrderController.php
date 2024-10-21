<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseOrderExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $orders = PurchaseOrder::get();
        return view('purchase_orders.list', compact('orders'));
    }

    public function add()
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        $items = Item::get();
        return view('purchase_orders.create', compact('suppliers', 'items'));
    }

    public function getItemDetails($id)
    {
        $item = Item::find($id);
        return response()->json([
            'item_no' => $item->id,
            'item_name' => $item->item_name,
            'stock_unit' => $item->stock_unit,
            'unit_price' => $item->unit_price,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_date' => 'required',
            'supplier_id' => 'required',
            'item_id' => 'required|array',
            'packing_unit' => 'required|array',
            'order_qty' => 'required|array',
            'item_amount' => 'required|array',
            'discount' => 'required|array',
            'net_amount' => 'required|array',
            'item_total' => 'required',
            'net_discount' => 'required',
            'total_net_amount' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $order = new PurchaseOrder();
        $order->order_date = $request->order_date;
        $order->supplier_id = $request->supplier_id;
        $order->item_total = $request->item_total;
        $order->discount = $request->net_discount;
        $order->net_amount = $request->total_net_amount;
        $order->save();


        foreach ($request->item_id as $index => $itemId) {
            $purchase = new PurchaseItem();
            $purchase->purchase_order_id = $order->id;
            $purchase->item_id = $itemId;
            $purchase->packing_unit = $request->packing_unit[$index];
            $purchase->order_qty = $request->order_qty[$index];
            $purchase->item_amount = $request->item_amount[$index];
            $purchase->discount = $request->discount[$index];
            $purchase->net_amount = $request->net_amount[$index];
            $purchase->save();
        }
        return redirect('/purchase-orders')->with('status', 'Purchase order added successfully!');
    }

    public function export($id)
    {
        return Excel::download(new PurchaseOrderExport($id), 'purchase_orders.xlsx');
    }

    public function print($id)
    {
        $order = PurchaseOrder::query()
            ->select(
                'purchase_orders.id as order_no',
                'purchase_orders.order_date',
                'suppliers.supplier_name',
                'purchase_orders.item_total',
                'purchase_orders.discount',
                'purchase_orders.net_amount',
                'items.id as item_no',
                'items.item_name',
                'items.stock_unit',
                'items.unit_price',
                'purchase_items.packing_unit',
                'purchase_items.order_qty',
                'purchase_items.item_amount',
                'purchase_items.discount as item_discount',
                'purchase_items.net_amount as item_net_amount'
            )
            ->join('suppliers', 'suppliers.id', 'purchase_orders.supplier_id')
            ->join('purchase_items', 'purchase_items.purchase_order_id', 'purchase_orders.id')
            ->join('items', 'items.id', 'purchase_items.item_id')
            ->where('purchase_orders.id', $id)
            ->get();

        $orders = PurchaseOrder::query()
            ->select(
                'purchase_orders.id as order_no',
                'purchase_orders.order_date',
                'suppliers.supplier_name',
                'purchase_orders.item_total',
                'purchase_orders.discount',
                'purchase_orders.net_amount'
            )
            ->join('suppliers', 'suppliers.id', 'purchase_orders.supplier_id')
            ->where('purchase_orders.id', $id)->first();
        $purchase_items = PurchaseItem::query()
            ->select(
                'purchase_orders.id',
                'items.id as item_no',
                'items.item_name',
                'items.stock_unit',
                'items.unit_price',
                'purchase_items.packing_unit',
                'purchase_items.order_qty',
                'purchase_items.item_amount',
                'purchase_items.discount as item_discount',
                'purchase_items.net_amount as item_net_amount'
            )
            ->join('purchase_orders', 'purchase_orders.id', 'purchase_items.purchase_order_id')
            ->join('items', 'items.id', 'purchase_items.item_id')
            ->where('purchase_orders.id', $id)->get();

        $pdf = Pdf::loadView('purchase_orders.print', compact('orders', 'purchase_items'));

        return $pdf->download();
    }
}
