<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\SponsorApartment;
use App\Image;
use Illuminate\Support\Facades\DB;

use App\Optional;
use Carbon\Carbon;

class ApartmentController extends Controller
{
    public function index() {

      return response()->json(Apartment::get(),200);
    }

    public function apartments(Apartment $apartment) {

      return response()->json($apartment,200);
    }


    
    public function search(Request $request) {
      // http://localhost:8000/api/search?numero_stanze=7&numero_letti=5
      // settiamo i parametri di ricerca
     $data = $request->all();
      $lat = isset($data['lat']) ? $data['lat'] : null;
      $lng = isset($data['lng']) ? $data['lng'] : null;
      $raggioKm = isset($data['raggioKm']) ? $data['raggioKm'] : 9999999;
      $numero_stanze = isset($data['numero_stanze']) ? $data['numero_stanze'] : 0;
      $numero_letti = isset($data['numero_letti']) ? $data['numero_letti'] : 0;
      $numero_bagni = isset($data['numero_bagni']) ? $data['numero_bagni'] : 0;
      $optionals = isset($data['optionals']) ? array_map('intval',explode(',',$data['optionals'])) : [];
      // filtriamo gli appartamenti che corrispondono ai criteri di ricerca
      $apartments = Apartment::where('attivo', '1')
      ->where('numero_stanze','>=', $numero_stanze)
      ->where('numero_letti','>=', $numero_letti)
      ->where('numero_bagni','>=', $numero_bagni)
      ->get();
      foreach ($apartments as $key => $apartment) {
        // estraggo tutti gli optionals di ogni appartamento
        $optionalAppNome = $apartment->optionals()->pluck('nome')->toarray();
        $optionalApp = $apartment->optionals()->pluck('id')->toarray();
        /* array_diff confronta gli elementi del primo array con gli elementi del secondo array e restituisce gli elementi del primo array che non ha trovato nel secondo array.
        con l'array degli optionals vuoto ritorna [] perchè non ha elementi da restituire
        con il ! davanti se non ci sono differenze ritorna true mentre ritorna false se trova differenze.
        */
        if (!array_diff($optionals,$optionalApp)){
          // se gli optionals corrispondono ai filtri di ricerca li aggiungo all'array degli appartamenti
          $apartment['optionals'] = $optionalAppNome;
          // aggiungo le immagini
          $apartment['immagini']  = $apartment->images()->pluck('immagine')->toarray();
          // calcolo la distanza dallle coordinate lat e lng passate con la ricerca
          $distanzaApp = distance($lat,$lng,$apartment->lat,$apartment->lng);
          if ($distanzaApp>$raggioKm){
             $apartments->forget($key);
          } else {
            $apartment['distanzaKm']  = $distanzaApp;
          }
          // prendiamo la data fine sponsorizzazione
          // $apartment['data_fine_sponsor']  = $apartment->SponsorApartments()->get()->sortByDesc('id');
          $apartment['data_fine_sponsor']  = Carbon::parse(SponsorApartment::where('apartment_id',$apartment->id)->pluck('data_fine')->sortDesc()->first());
          // se la data fine sponsor è passata allora mettiamo valore ''
          ($apartment['data_fine_sponsor']->isPast()) ? $apartment['data_fine_sponsor']='': $apartment['data_fine_sponsor'];

        } else {
          // se gli optionals non corrispondono ai filtri di ricerca elimino l'appartamento dall'array
          $apartments->forget($key);
        }
      }
     return response()->json($apartments);
    }

    public function attivaApp(request $request){
      // http://localhost:8000/api/attivaApp?apartmentId=2
      $data = $request->all();
      $apartment = Apartment::find($data['apartmentId']); //dato da passare all'API apartmentId
      $attivo = $apartment->attivo;
      if($attivo == 1){
        $update = ['attivo' => 0];
      } else {
        $update = ['attivo' => 1];
      }
      $apartment->update($update);
      return json_encode(['success' => 'success']);
    }
    
     public function statistiche(request $request){
      // http://localhost:8000/api/statistiche?apartmentId=2

      /* 
      SELECT  MONTH(visits.data_visita) AS 'mese', COUNT(visits.id)
      FROM `apartments`
      JOIN `visits` ON apartments.id = visits.apartment_id
      WHERE apartments.id = 2
      GROUP BY apartments.id , mese
      */
      $data = $request->all();
      $apartment = Apartment::find($data['apartmentId']); //dato da passare all'API apartmentId
      
      
      for ($i=1; $i <13; $i++){
        $anno = Carbon::now()->format('Y');
        
        $statistiche['visite'][] = $apartment->visits()-> whereMonth('data_visita', $i) -> whereYear('data_visita', $anno) -> count() ;$statistiche['messaggi'][] = $apartment->messages()-> whereMonth('created_at', $i) -> whereYear('created_at', $anno) -> count() ;
      };


      return response()->json($statistiche);

      
    }

}

// formula matematica per il calcolo della distanza in km tra due punti identificati dalle coordinate latitudine e longitudine
    function distance($lat1, $lon1, $lat2, $lon2) {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return $km;
    }
