<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockToProduct extends Model
{
    protected $fillable = [
        'stock_id', 'product_id', 'quantity'
    ];

    // Table Name
    protected $table = 'stock_to_products';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function stock() { return $this->belongsTo('App\Stock'); }
    public function product() { return $this->belongsTo('App\Product'); }
}
