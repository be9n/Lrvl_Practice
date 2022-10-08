<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'adress',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function doctors(){
        return $this -> hasMany('App\Models\Doctor', 'hospital_id', 'id');

    }
}
