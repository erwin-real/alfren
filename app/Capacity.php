<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    protected $fillable = [
        'capacity_date', 'total'
    ];

//    public $sortable = [
//        'name', 'desc', 'srp', 'source',
//        'contact', 'stocks', 'created_at', 'updated_at',
//    ];

    // Table Name
    protected $table = 'capacities';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

}
