<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaySoDo extends Model
{
    use HasFactory;

    public $timestamp = false;
    protected $fillable = [
        'title',
        'content_1',
        'content_2',
    ];

    protected $primary = 'id';
    protected $table = 'tbl_lay_sodo';
}
