<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 */
class Product extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        'supplier_ids',
        'product_code',
        'product_name',
        'description',
        'standard_cost',
        'list_price',
        'reorder_level',
        'target_level',
        'quantity_per_unit',
        'discontinued',
        'minimum_reorder_quantity',
        'category',
        'attachments'
    ];

    protected $guarded = [];

        
}
