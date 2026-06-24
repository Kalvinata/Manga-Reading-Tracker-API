<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistrictModel extends Model
{
    use SoftDeletes;

    protected $table = 'district';

    protected $primaryKey = 'district_id';

    protected $fillable = [
        'city_id',
        'district_code',
        'district_name'
    ];

    public $timestamps = true;
}