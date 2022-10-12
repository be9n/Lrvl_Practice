<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'age',
    ];

    protected $hidden = [
    ];

    //has one through
    public function doctor(){
        return $this -> hasOneThrough('App\Models\Doctor','App\Models\Medical','patient_id','medical_id');
    }
    public function medical(){
        return $this -> hasOne('App\Models\Medical', 'patient_id');
    }
}
