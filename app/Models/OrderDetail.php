<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderDetail
 */
class OrderDetail extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'order_details';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount',
        'status_id',
        'date_allocated',
        'purchase_order_id',
        'inventory_id'
    ];

    protected $guarded = [];

        
}
