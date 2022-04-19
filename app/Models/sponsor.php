<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sponsor extends Model
{
    use HasFactory;

    protected $table = 'sponsors';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'mes',
        'anio',
        'is_act',
    ];

}
