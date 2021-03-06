<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingleOrder extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'price', 'quantity'
    ];

    // Table Name
    protected $table = 'single_orders';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function order() { return $this->belongsTo('App\Order'); }
    public function product() { return $this->belongsTo('App\Product'); }
}
