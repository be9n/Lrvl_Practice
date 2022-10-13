<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class CollectController extends Controller
{
    //

    public function index(){
       /* $numbers = [1,2,3,4,5];
        $col = collect($numbers);
        $avg = $col -> average();*/

        /*$coll = collect(['name', 'age']);
       $combined = $coll -> combine(['name' => 'Apo','age' => '22']);
        return $combined;*/

        /*$ages = collect([1,4,6,4,1,2]);
       return $ages -> countBy();*/
    }

    public function complex(){
        $offers = Offer::withOutGlobalScopes()-> get();

        //remove
        $offers -> each(function ($offer){
           // $offer -> makeHidden('price');
            if($offer -> price != 12){
                 unset($offer -> price);
            }
            if ($offer -> status == 0){
                 unset($offer -> photo);
            }

            // Add column
           $offer ->age = 22;

           return $offer;
        });
        return $offers;
    }

    public function filter(){
        $offers = Offer::withOutGlobalScopes()-> get();

        //$offers = collect($offers);

       $filtered = $offers -> filter(function ($value, $key){
            //return $value['status'] == 1;
            return $value -> status == 1;
        });

       //return array_values($filtered -> all());
        return $filtered;
    }

    public function transform(){
        $offers = Offer::withOutGlobalScopes()-> get();

        //$offers = collect($offers);

        $transformed = $offers -> transform(function ($value, $key){
           // $data = [];
            $data['name'] = $value['name'];
            $data['age'] = 22;
            return $data;
            return 'The name is:'.$value['name'];
           // return 'The name is:'.$value -> name;
        });

      //  return array_values($transformed -> all());
        return $transformed;
    }
}
