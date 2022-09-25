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
        /* $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
        ];*/

        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // return $validator->errors()->first();
            return $validator->errors();
        }

        //insert
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'detailes' => $request->detailes,
        ]);
    }

    protected function getMessages()
    {
        return $messages = [
            'name.required' => "don't do this",
        ];
    }

    protected function getRules()
    {
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
        ];
    }
}
