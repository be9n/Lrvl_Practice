<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    public $timestamps = true;

    
    protected $fillable = [
        'name', 
        'price', 
        'photo',
        'detailes',
        'created_at', 
        'updated_at'
    ];


    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
}

