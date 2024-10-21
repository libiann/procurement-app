<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['item_name', 'inventory_location', 'brand', 'category', 'supplier_id', 'stock_unit', 'unit_price', 'status'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }
}
