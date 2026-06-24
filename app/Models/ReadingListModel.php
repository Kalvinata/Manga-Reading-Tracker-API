<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReadingListModel extends Model
{
    use SoftDeletes;

    protected $table = 'reading_list';

    protected $primaryKey = 'reading_list_id';

    protected $fillable = [
        'manga_id',
        'user_id',
        'reading_status',
        'chapter_read',
        'rating',
        'notes'
    ];

    public $timestamps = true;
}