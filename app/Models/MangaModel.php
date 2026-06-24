<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MangaModel extends Model
{
    use SoftDeletes;

    protected $table = 'manga';

    protected $primaryKey = 'manga_id';

    protected $fillable = [
        'genre_id',
        'manga_code',
        'manga_title',
        'author',
        'status'
    ];

    public $timestamps = true;
}