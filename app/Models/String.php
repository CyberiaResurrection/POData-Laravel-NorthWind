<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class String
 */
class String extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'strings';

    protected $primaryKey = 'string_id';

	public $timestamps = false;

    protected $fillable = [
        'string_data'
    ];

    protected $guarded = [];

        
}
