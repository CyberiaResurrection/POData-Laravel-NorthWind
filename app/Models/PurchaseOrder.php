<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseOrder
 */
class PurchaseOrder extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'purchase_orders';

    public $timestamps = false;

    protected $fillable = [
        'supplier_id',
        'created_by',
        'submitted_date',
        'creation_date',
        'status_id',
        'expected_date',
        'shipping_fee',
        'taxes',
        'payment_date',
        'payment_amount',
        'payment_method',
        'notes',
        'approved_by',
        'approved_date',
        'submitted_by'
    ];

    protected $guarded = [];

    public function Supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
    public function PurchaseOrderStatus(){
        return $this->belongsTo('App\Models\PurchaseOrderStatus', 'status_id');
    }
}
