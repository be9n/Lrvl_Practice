<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{


    public function getOffers()
    {
        // return Offer::get();
        return Offer::select('id', 'name')->get();
    }



    public function create()
    {
        return view('offers.create');
    }



    public function store(Request $request)
    {

        // validate data before insert to database

        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // return $validator->errors()->first();
           // return $validator->errors();
           return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        //insert
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'detailes' => $request->detailes,
        ]);
        
        return redirect()->back()->with('success', 'The offer added successfully!!');
    }

    protected function getRules()
    {
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
        ];
    }

    protected function getMessages()
    {
        return $messages = [
            'name.required' => trans('messages.offer name required'),
            'price.required' => __('messages.offer price required'),
            'price.numeric' => __('messages.offer price numeric')
        ];
    }
}
