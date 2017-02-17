<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Privilege
 */
class Privilege extends Model
{
    use \AlgoWeb\PODataLaravel\Models\MetadataTrait;
    protected $table = 'privileges';

    public $timestamps = false;

    protected $fillable = [
        'privilege_name'
    ];

    protected $guarded = [];

    public function privileges()
    {
        return $this->belongsToMany(Employee::class, 'employee_privileges');
    }
}
