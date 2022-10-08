<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
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

    public function hasMany(){
      /*  $hospital = Hospital::with('doctors')->get();
        return $hospital;
        $hospital = Hospital::find(2);
        return $hospital->doctors;*/


       /* $hospital = Hospital::with('doctors')->find(2);
        return $hospital->doctors -> find(4) -> name;*/


      /*  $doctor =Doctor::with('hospital')->find(4);
        return $doctor -> hospital ->name;*/


        /*$hospital = Hospital::with('doctors') -> find(1);
        $doctors = $hospital -> doctors;

        foreach ($doctors as $doctor){
            echo $doctor -> name.'<br>';
        }*/

        $doctor = Doctor::find(3);
        return $doctor -> hospital -> name;

    }

    public function showHospitals(){
        $hospitals = Hospital::get();
        return view('hospitals.showHospitals', compact('hospitals'));
    }

    public function showDoctors($hospital_id){
        $hospital = Hospital::find($hospital_id);

        $doctors = $hospital -> doctors;
        $doctors -> makeHidden(['hospital_id']);
        return view('hospitals.doctors.showDoctors', compact('doctors'));
    }
}
