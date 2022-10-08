<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'mobile',
        'user_id',

    ];

    protected $hidden = [
        //
    ];

    ########################## Relations ############################
    public function user(){                                 // Default tableName_id
        return $this -> belongsTo('App\Models\User','user_id');
    }
    ########################## Relations ############################
}
