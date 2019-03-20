<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'name', 'category', 'description',
        'stocks'
    ];

//    public $sortable = [
//        'name', 'desc', 'srp', 'source',
//        'contact', 'stocks', 'created_at', 'updated_at',
//    ];

    // Table Name
    protected $table = 'stocks';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function stockToProducts() { return $this->hasMany('App\StockToProduct'); }
}
