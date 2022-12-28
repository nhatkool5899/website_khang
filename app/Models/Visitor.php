<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;


    public $timestamp = false;
    protected $fillable = [
        'ip_address',
        'data_visitor',
    ];

    protected $primary = 'id';
    protected $table = 'tbl_visitor';
}
