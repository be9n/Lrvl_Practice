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
        'address',
        'country_id',
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

    public function delete()
    {
        foreach ($this->doctors as $doctor) {
            $doctor->delete();
        }
        return parent::delete();
    }


}
