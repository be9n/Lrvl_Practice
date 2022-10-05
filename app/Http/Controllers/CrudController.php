<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
   
    use OfferTrait;
   
    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {

        // validate data before insert to database

       /* $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // return $validator->errors()->first();
           // return $validator->errors();
           return redirect()->back()->withErrors($validator)->withInput($request->all());
        }*/

        //insert

       $file_name = $this->saveImage($request->photo, 'images/offers');

        Offer::create([
            'photo' => $file_name,
            'name' => $request->name,
            'price' => $request->price,
            'detailes' => $request->detailes,
        ]);
        
        return redirect()->back()->with('success', 'The offer added successfully!!');
    }


    //In OfferTrait!!
   /* protected function saveImage($photo, $folder){
        $file_extantion = $photo->getClientOriginalExtension();
        $file_name = time().'.'.$file_extantion;
        $path = $folder;

        $photo->move($path, $file_name);
        
        return $file_name;
    }*/ 

    public function getOffers(){
        
      $offers = Offer::select()->get()->all();
      return view('offers.showOffers', compact('offers'));
    }


    public function editOffers($offer_id){
        //Offer::findOrFail($offer_id);

        $offer = Offer::find($offer_id);
        if(!$offer)
        return redirect()->back();

        $Offer = Offer::select('name', 'price', 'detailes')->find($offer_id);
        return view('offers.edit', compact('offer'));
    }

    public function updateOffers(OfferRequest $request, $offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer)
        return redirect()->back();

        $offer -> update($request -> all());
        return redirect()->back() -> with(['success' => 'Updated Successfully!!']);
    }

    public function deleteOffers($offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer)
        return redirect()->route('getAllOffers') -> with(['fail' => "There's no such offer!"]);

        $offer -> delete();
        return redirect()-> route('getAllOffers') -> with(['success' => 'The offer has been deleted successfully!!']);
    }
    

    public function getVideo(){

       $video = Video::first();
       event(new VideoViewer($video));
        return view('video')->with('video', $video);
    }

    /*protected function getRules()
    {
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
        ];
    }*/

    /*protected function getMessages()
    {
        return $messages = [
            'name.required' => trans('messages.offer name required'),
            'price.required' => __('messages.offer price required'),
            'price.numeric' => __('messages.offer price numeric')
        ];
    }*/
}
