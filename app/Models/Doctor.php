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
        'hospital_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Hospital(){
        return $this -> belongsTo('App\Models\Hospital', 'hospital_id', 'id');
    }
}
