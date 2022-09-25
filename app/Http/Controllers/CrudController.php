<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    

    public function getOffers(){
       // return Offer::get();
        return Offer::select('id', 'name')->get();
    }

   

    public function create(){
        return view('offers.create');
    }

    

    public function store(Request $request){

        $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
        ];

        $messages = [
            'name.required' => "don't do that",
        ];
        // validate data before insert to database
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator -> fails()){
           // return $validator->errors()->first();
            return $validator->errors();
        }

        //insert
        Offer::create([
            'name' => $request -> name,
            'price' => $request -> price,
            'detailes' => $request -> detailes,
        ]);
        
    }
}
