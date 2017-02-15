<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderDetailsStatus
 */
class OrderDetailsStatus extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'order_details_status';

    public $timestamps = false;

    protected $fillable = [
        'status_name'
    ];

    protected $guarded = [];

        
}
