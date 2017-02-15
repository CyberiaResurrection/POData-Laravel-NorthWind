<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InventoryTransaction
 */
class InventoryTransaction extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'inventory_transactions';

    public $timestamps = false;

    protected $fillable = [
        'transaction_type',
        'transaction_created_date',
        'transaction_modified_date',
        'product_id',
        'quantity',
        'purchase_order_id',
        'customer_order_id',
        'comments'
    ];

    protected $guarded = [];

        
}
