<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = ['purchase_order_id', 'item_id', 'packing_unit', 'order_qty', 'item_amount', ' discount', 'net_amount'];
}
