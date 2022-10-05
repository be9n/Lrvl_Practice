<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    
   // use OfferTrait;
    public function create(){
        return view('ajaxOffers.create');
    }

    public function store(Request $request){

       // $file_name = $this->saveImage($request->photo, 'images/offers');

        Offer::create([
           // 'photo' => $file_name,
            'name' => $request->name,
            'price' => $request->price,
            'detailes' => $request->detailes,
        ]);
    }
}
