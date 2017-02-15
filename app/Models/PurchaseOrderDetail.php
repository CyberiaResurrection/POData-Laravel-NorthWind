<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseOrderDetail
 */
class PurchaseOrderDetail extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'purchase_order_details';

    public $timestamps = false;

    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'unit_cost',
        'date_received',
        'posted_to_inventory',
        'inventory_id'
    ];

    protected $guarded = [];

        
}
