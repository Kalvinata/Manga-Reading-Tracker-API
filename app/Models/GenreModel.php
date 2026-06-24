<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class GenreModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'genre';

    protected $primaryKey = 'genre_id';

    protected $fillable = [
        'genre_id',
        'genre_code',
        'genre_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}