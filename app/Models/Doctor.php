<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'title',
        'gender',
        'hospital_id',
        'medical_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function scopeMale(){
        return $this -> where('gender', 1);
    }

    public function Hospital(){
        return $this -> belongsTo('App\Models\Hospital', 'hospital_id', 'id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service', 'doctor_service', 'doctor_id', 'service_id');
    }

    public function patients(){
        return $this -> hasManyThrough('App\Models\Patient', 'App\Models\Medical', 'doctor_id', 'medical_id');
    }

    public function delete()
    {
        $this->services()->detach();
        return parent::delete();
    }

    //accessor
    public function getGenderAttribute($val){
        return $val == 1 ? 'male' : 'female';
    }




}
