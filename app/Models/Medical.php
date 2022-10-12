<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    protected $table = 'medicals';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'pdf',
        'patient_id',
    ];

    protected $hidden = [
    ];

    public function patient(){
        return $this -> belongsTo('App\Models\Patient', 'patient_id');
    }
}
