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
      $apartments = Apartment::where('attivo','1')->get();
      $optionals = Optional::all();

      foreach ($apartments as $key =>$apartment) {
        $images = Image::where('apartment_id', $apartment->id)->pluck('immagine')->first();
        $apartment['immagine'] = $images;

        // nel caso volessimo avere più immagini per ogni appartamento
        // $apartment['immagini']  = $apartment->images()->pluck('immagine')->toarray();

        // prendiamo la data fine sponsorizzazione 
        $apartment['data_fine_sponsor']  = Carbon::parse(SponsorApartment::where('apartment_id',$apartment->id)->pluck('data_fine')->sortDesc()->first());
        // se la data fine sponsor è passata sponsorizzato = 0 se no =1
        ($apartment['data_fine_sponsor']->isPast()) ? $apartment['sponsorizzato']=0: $apartment['sponsorizzato']=1;

      }
      // riordiniamo l'array degli appartamenti mettendo per primi quelli sponsorizzati
      $apartments = $apartments->sortByDesc('sponsorizzato');

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
