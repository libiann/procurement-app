<?php

namespace App\Exports;

use App\Models\PurchaseOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseOrderExport implements FromCollection, WithHeadings
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PurchaseOrder::query()
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
            ->where('purchase_orders.id', $this->id)
            ->get();
    }

    public function headings(): array
    {
        return ["Order No", "Order Date", "Supplier Name", "Item total", "Discount", "Net Amount", "Item no", "Item name", "Stock unit", "Unit price", "Packing_unit", "Order quantity", "Item total", "Item discount", "Item net amount"];
    }
}
