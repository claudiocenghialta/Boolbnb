<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Optional;
use App\Image;
use App\Sponsor;
use App\Visit;
use Carbon\Carbon;
use App\SponsorApartment;

class ApartmentController extends Controller
{
    public function index() {
      $apartmentsAll = Apartment::all();
      $optionals = Optional::all();

      // $images = Image::all();
      $apartments = [];

      foreach ($apartmentsAll as $apartment) {
        $images = Image::where('apartment_id', $apartment->id)->pluck('immagine')->first();

        $apartment['immagine'] = $images;

        $apartments[] = $apartment;

      }

      return view('welcome', compact('apartments', 'optionals'));
    }

    public function show(Apartment $apartment) {

      $optionals = Optional::all();
      $sponsors = Sponsor::all();
      $images= Image::where('apartment_id', $apartment->id)->get();

          $proprietario = false;
          // incremento contatore visite
          $newVisit = new Visit;
          $newVisit->apartment_id = $apartment->id;
          $newVisit->data_visita = Carbon::now();
          $newVisit->save();

      return view('admin.show',compact('apartment', 'optionals', 'images', 'proprietario',  'sponsors'));
    }
}
