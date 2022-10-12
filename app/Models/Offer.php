<?php

namespace App\Models;

use App\Models\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    public $timestamps = true;

    protected static function booted()
    {
        static::addGlobalScope(new OfferScope);
    }


    public function scopeInactive($query){
        return $query -> where('status', 0);
    }

    public function scopeValid($query){
        return $query -> where('status', 1);
    }

    public function scopePrice($query){
        return $query -> where('price', 12);
    }

    protected $fillable = [
        'name',
        'price',
        'photo',
        'detailes',
        'status',
        'created_at',
        'updated_at'
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    //mutator          //if first_name >> FirstName
    public function setNameAttribute($val){
        return $this ->attributes['name'] = strtoupper($val);
    }
}

