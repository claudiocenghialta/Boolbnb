<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Sponsor;
use App\SponsorApartment;
use Carbon\Carbon;



class SponsorApartmentController extends Controller
{
    public function store(Request $request){
        // controllo dati ricevuti da chiamata API
       $validator = Validator::make($request->all(), [
            'sponsor_id' => 'numeric|exists:sponsors,id',
            'apartment_id' => 'numeric|exists:apartments,id',
        ]);
        // se dati ricevuti non sono corretti, restituisco JSON di errore
        if ($validator->fails()) {
            return response()->json(['Messaggio'=>'Errore inserimento']);
        }
        // controllo se ultima data di fine per questo apartment_id è maggiore della data attuale
        // allora prendo ultima data fine come inizio della nuova sponsorizzazione
        $ora = Carbon::now();
        $ultimaDataFine = Carbon::parse(SponsorApartment::where('apartment_id',$request->apartment_id)->pluck('data_fine')->sortDesc()->first());
        if($ultimaDataFine->greaterThan($ora)){
            $request['data_inizio'] = $ultimaDataFine;
        } else {
            $request['data_inizio'] = $ora;
        };
        // aggiungo durata alla data inizio e calcolo data fine
        $durata = Sponsor::where('id',$request->sponsor_id)->pluck('durata')->first();
        $request['data_fine'] = Carbon::parse($request['data_inizio'])->addHours($durata);
        // scrivo dati su database e restituisco JSON di risposta
        $sponsorApartment = SponsorApartment::create($request->all());
        return response()->json($sponsorApartment,201);

        dd($sponsorApartment);

    }

}
