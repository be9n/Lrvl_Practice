<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    //public $timestamps = false;

    
    protected $fillable = [
        'name', 
        'price', 
        'detailes',
        'created_at', 
        'updated_at'
    ];


    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
}

