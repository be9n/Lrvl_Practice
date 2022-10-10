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
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function Hospital(){
        return $this -> belongsTo('App\Models\Hospital', 'hospital_id', 'id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service', 'doctor_service', 'doctor_id', 'service_id');
    }

    public function delete()
    {
        $this->services()->detach();
        return parent::delete();
    }
}
