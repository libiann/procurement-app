<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['order_date', 'supplier_id', 'item_total', ' discount', 'net_amount'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
