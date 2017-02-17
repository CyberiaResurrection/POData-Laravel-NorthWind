<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdersStatus
 */
class OrdersStatus extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'orders_status';

    public $timestamps = false;

    protected $fillable = [
        'status_name'
    ];

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\Models\OrdersStatus', 'status_id');
    }
}
