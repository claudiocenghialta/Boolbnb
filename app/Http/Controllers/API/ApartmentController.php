<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Image;
use App\Optional;

class ApartmentController extends Controller
{
    public function index() {

      return response()->json(Apartment::get(),200);
    }

    public function apartments(Apartment $apartment) {

      return response()->json($apartment,200);
    }

    public function search(Request $request) {
     $data = $request->all();


      $lat = isset($data['lat']) ? $data['lat'] : null;
      $lng = isset($data['lng']) ? $data['lng'] : null;
      $raggioKm = isset($data['raggioKm']) ? $data['raggioKm'] : null;
      $numero_stanze = isset($data['numero_stanze']) ? $data['numero_stanze'] : 0;
      $numero_letti = isset($data['numero_letti']) ? $data['numero_letti'] : 0;
      $optionals = isset($data['optionals']) ? explode(',',$data['optionals']) : null;

      // dd($optionals);
      $apartments = Apartment::where('attivo', '1')
      ->where('numero_stanze','>=', $numero_stanze)
      ->where('numero_letti','>=', $numero_letti)
      ->get();

      foreach ($apartments as $apartment) {
        $optional = $apartment->optionals()->pluck('id');

        $apartment['optionals'] = $optional;

        dd($apartment);

        //aggiungere le immagine legate ad ogni appartamento e calcolare distanza da input ad appartamento

      }

      dd($apartments);


     return response()->json($data);
    }


}
