<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
    ];

    public function doctors(){
        return $this->hasManyThrough('App\Models\Doctor', 'App\Models\Hospital');
    }
}
