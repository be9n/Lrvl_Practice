<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Scopes\OfferScope;
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
            'name' =>  $request->name,
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
        ]);

    }

    public function all(){
        //$offers = Offer::select()->get();
        $offers = Offer::select()->paginate(PAGINATION_COUNT);

        return view('offers.offersPaginate', compact('offers'));
       // return view('ajaxOffers.all', compact('offers'));
    }

    public function update1(Request $request){


        $offer = Offer::find($request->offer_id);
        if(!$offer)
            return 'np';

        $file_name = $this->saveImage($request->photo, 'images/offers');

        $validData = [
            'photo'=> $file_name,
            'name' => $request -> name,
            'price' => $request -> price,
            'detailes' => $request -> detailes
        ];

        $offer -> update($validData);
        return response()->json([
            'status' => true,
            'msg' => 'updated successfully',
        ]);
    }



    public function edit($offer_id){
        //Offer::findOrFail($offer_id);

        $offer = Offer::find($offer_id);
        if(!$offer)
            return response()->json([
                'status' => true,
            ]);

        $Offer = Offer::select('name', 'price', 'detailes')->find($offer_id);
        return view('ajaxOffers.edit', compact('offer'));
    }

    public function getAllInactiveOffers(){
       // $inactiveOffers = Offer::valid()->get();

                //Global scope applied
        $inactiveOffers = Offer::get();

        //$inactiveOffers = Offer::withoutGlobalScopes() -> get();

        /*$inactiveOffers = Offer::withoutGlobalScopes([
            OfferScope::class, SecondScope::class
        ]) -> get();*/

        return $inactiveOffers;
    }
}
