<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

//    public $sortable = [
//        'name', 'desc', 'srp', 'source',
//        'contact', 'stocks', 'created_at', 'updated_at',
//    ];

    // Table Name
    protected $table = 'products';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function stockToProducts() { return $this->hasMany('App\StockToProduct'); }
    public function singleOrders() { return $this->hasMany('App\SingleOrder'); }
}
