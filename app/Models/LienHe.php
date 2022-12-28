<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
        'title',
        'content',
    ];

    protected $primary = 'id';
    protected $table = 'tbl_lienhe';
}
