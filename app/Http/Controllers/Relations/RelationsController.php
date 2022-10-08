<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\User;

class RelationsController extends Controller
{
    public function hasOne(){
        $user = User::with(['mobile' => function($q){
            $q -> select('code', 'mobile', 'user_id');
        }])->find(8);

        return $user -> mobile -> code;
        //$phone = $user -> mobile;
        return response()->json($user);
    }

    public function hasOneReveres(){
      /* $phone = Phone::with(['user' => function($q){
          $q -> select(
           'id',
           'name',
           'email',
          );
       }]) -> find(1);*/

      /* $phone -> makeVisible(['user_id']);
       $phone -> makeHidden(['user_id']);*/
        $phone = Phone::with('user')->find(1);

       return $phone;
    }

    public function userHasPhone(){
       // $user = User::whereHas('mobile') -> get();

        $user = User::whereHas('mobile', function ($q){
            $q -> where('code', '+966');
        }) -> get();

        return $user;
    }

    public function userDontHavePhone(){
        $user = User::whereDoesntHave('mobile') -> get();

        return $user;
    }
}
