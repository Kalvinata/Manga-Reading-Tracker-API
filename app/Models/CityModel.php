<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityModel extends Model
{
    use SoftDeletes;

    protected $table = 'city';

    protected $primaryKey = 'city_id';

    protected $fillable = [
        'province_id',
        'city_code',
        'city_name'
    ];

    public $timestamps = true;
}