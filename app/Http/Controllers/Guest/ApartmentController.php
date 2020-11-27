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
      $metePopolari = [
        [ 'citta'=> 'Torino',
          'indirizzo'=>'Torino, Piemonte, Italia',
          'img'=> 'torino.jpg',
          'lat'=>45.0677,
          'lng'=>7.6824
        ],
        [ 'citta'=> 'Milano',
          'indirizzo'=>'Milano, Lombardia, Italia',
          'img'=> 'milano.jpg',
          'lat'=>45.4668,
          'lng'=>9.1905
        ],
        [ 'citta'=> 'Roma',
          'indirizzo'=>'Roma, Lazio, Italia',
          'img'=> 'roma.jpg',
          'lat'=>41.8948,
          'lng'=>12.4853
        ],
        [ 'citta'=> 'Bologna',
          'indirizzo'=>'Bologna, Emilia-Romagna, Italia',
          'img'=> 'bologna.jpg',
          'lat'=>44.4937,
          'lng'=>11.343
        ],
        [ 'citta'=> 'Firenze',
          'indirizzo'=>'Firenze, Toscana, Italia',
          'img'=> 'firenze.jpg',
          'lat'=>43.7699,
          'lng'=>11.2556
        ],
        [ 'citta'=> 'Napoli',
          'indirizzo'=>'Napoli, Campania, Italia',
          'img'=> 'napoli.jpg',
          'lat'=>40.8359,
          'lng'=>14.2488
        ],
        
      ];

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
      // $apartments = $apartments->sortByDesc('sponsorizzato');
      $apartments = $apartments->where('sponsorizzato','=',1);

      return view('welcome', compact('apartments', 'optionals', 'metePopolari'));
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
