<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    use OfferTrait;
    public function create()
    {
        return view('ajaxOffers.ajaxCreate');
    }

    public function store(OfferRequest $request)
    {

        $file_name = $this->saveImage($request->photo, 'images/offers');

       $offer = Offer::create([
            'photo' => $file_name,
            'name' => $request->name,
            'price' => $request->price,
            'detailes' => $request->detailes,
        ]);

        if ($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'saved successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'failed to save!!',
            ]);
        }
    }

    public function delete(Request $request){
        $offer = Offer::find($request->id);


        $offer -> delete();

        return response()->json([
            'status' => true,
            'msg' => 'deleted successfully',
            'data' => $request -> id
        ]);

    }

    public function all(){
        $offers = Offer::select()->get();
        return view('ajaxOffers.all', compact('offers'));
    }
}
