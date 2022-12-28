<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatMay extends Model
{
    use HasFactory;

    public $timestamp = false;
    protected $fillable = [
        'title_1',
        'title_2',
        'title_3',
        'content_1',
        'content_2',
        'content_3',
    ];

    protected $primary = 'id';
    protected $table = 'tbl_dat_may';
}
