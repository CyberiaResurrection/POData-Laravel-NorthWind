<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdersTaxStatus
 */
class OrdersTaxStatus extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'orders_tax_status';

    public $timestamps = false;

    protected $fillable = [
        'tax_status_name'
    ];

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\Models\OrdersTaxStatus', 'tax_status_id');
    }
}
