<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'total_capacity', 'ready_by'
    ];

//    public $sortable = [
//        'name', 'desc', 'srp', 'source',
//        'contact', 'stocks', 'created_at', 'updated_at',
//    ];

    // Table Name
    protected $table = 'orders';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function singleOrders() { return $this->hasMany('App\SingleOrder'); }
}
