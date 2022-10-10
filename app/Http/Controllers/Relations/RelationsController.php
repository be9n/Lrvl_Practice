<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

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
        // Show the hospitals that has male doctors
       /* $hospitals = Hospital::whereHas('doctors', function ($q){
            $q -> where('gender', '1');
        })->get();*/

        // Show the hospitals that has just female doctors
       /* $hospitals = Hospital::whereDoesntHave('doctors', function ($q){
            $q -> where('gender', '1');
        })->get();*/

        $hospitals = Hospital::get();

        return view('hospitals.showHospitals', compact('hospitals'));


    }

    public function showDoctors($hospital_id){
        $hospital = Hospital::find($hospital_id);

        // Show the male doctors
        //$doctors = $hospital -> doctors -> where('gender', '0');

        $doctors = $hospital -> doctors;
        $doctors -> makeHidden(['hospital_id']);
        return view('hospitals.doctors.showDoctors', compact('doctors', 'hospital_id'));
    }

    public function deleteHospital(Request $request){
       $hospital = Hospital::find($request -> id);
       if(!$hospital)
           return abort('404');


       $hospital -> delete();
    }

    public function getDoctorServices(){
       /* $service = Service::with('doctors')->get();
        return $service;*/
        $doctor = Doctor::with(['services' => function($q){
            $q -> select(['services.id', 'name']);
        }])->find(1);
        return $doctor;
    }

    public function showServices($doctor_id){
        $data['doctor'] = Doctor::with('services')->find($doctor_id);
        $data['services'] = $data['doctor']->services;

        $data['emptyServices'] = Service::whereDoesntHave('doctors', function ($q) use ($doctor_id) {
            $q -> where('doctors.id', $doctor_id);
        })->get();
        $data['hospital_id'] = $data['doctor'] -> hospital -> id;
        return view('hospitals.doctors.services.services', compact('data','doctor_id'));
    }

    public function addService($service_id, $doctor_id){
        $doctor = Doctor::find($doctor_id);
        if(!$doctor_id)
            return abort('404');


        $doctor -> services() -> attach($service_id);
        return redirect()->back();
    }

    public function addSelectService(Request $request, $doctor_id){

        $doctor = Doctor::find($doctor_id);
        if(!$doctor_id)
            return abort('404');


        $doctor -> services() -> attach($request -> servicesIds);
        return redirect()->back();
    }

    public function deleteService($service_id, $doctor_id){
        $service = Service::find($service_id);
        if(!$service_id)
            return abort('404');

        if($service -> doctors()->detach($doctor_id))
        return redirect() -> back();
    }

    public function addDoctors(Request $request){

        if(Doctor::create($request -> all())) {
            return redirect() -> back();
        }else{
            return 'hata';
        }
    }

    public function deleteDoctor($doctor_id){
        $doctor = Doctor::find($doctor_id);
       if($doctor->delete()){
           return redirect() -> back();
       }else{
           return 'hata';
       }
    }

    public function addHospital(Request $request){
        if(Hospital::create($request -> all())) {
            return redirect() -> back();
        }else{
            return 'hata';
        }
    }
}
