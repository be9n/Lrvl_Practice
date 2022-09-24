<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    

    public function getOffers(){
       // return Offer::get();
        return Offer::select('id', 'name')->get();
    }

    public function store(){
        Offer::create([
            'name' => 'iPhone 14 Pro',
            'price' => '5400',
            'detailes' => '512GB'
        ]);
    }

    public function create(){
        return view('offers.create');
    }
}
