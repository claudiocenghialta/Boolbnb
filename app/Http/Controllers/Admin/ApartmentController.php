<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Apartment;
use App\Optional;
use App\Image;
use App\User;
use App\Message;
use App\Visit;
use App\Sponsor;
use App\SponsorApartment;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $apartments = Apartment::where('user_id',Auth::id())->get();

      return view('admin.index', compact('apartments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $optionals = Optional::all();
        return view('admin.create',compact('optionals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();
      // aggiunta controlli
      $request->validate([
        'titolo' => 'required|min:5|max:100',
        'descrizione' => 'required|min:10|max:500',
        'numero_stanze' => 'required|integer|min:1|max:20',
        'numero_letti' => 'required|integer|min:1|max:40',
        'numero_bagni' => 'required|integer|min:1|max:20',
        'mq' => 'nullable|integer|min:15|max:1000',
        'indirizzo' => 'required|min:5|max:255'
      ]);
      $data['user_id'] = Auth::id();
      $data['slug']= Str::finish(Str::slug($data['titolo'],'-'),rand(1,10000));
      //nuova istanza
      $newApartment = New Apartment;

      //get imgs to put in public folder images

      //popolo
      $newApartment->fill($data);

      //salvo
      $saved = $newApartment->save();

      for ($i=0; $i <5 ; $i++) {
          if (!empty($data['img'.$i])) {
            // salviamo l'img inserita nel form nella cartella storage/app/public/images
            $data['img'.$i] = Storage::disk('public')->put('images',$data['img'.$i]);
            // creiamo una nuova istanza della classe images
            $newImage = New Image;
            // Compiliamo i dati della colonne immagine e apartment_id
            $newImage->immagine = $data['img'.$i];
            $newImage->apartment_id = $newApartment->id;
            // Salviamo l'immagine nel database
            $newImage->save();
          }
      }

      // $newApartment->optionals()->attach($data['optionals']);

      //se non ci sono optional non va in errore
      if (!empty($data['optionals'])) {
        $newApartment->optionals()->attach($data['optionals']);
      }

      // dd($data['img']);
      // $images= Image::where('apartment_id', $newApartment->id)->get();

      // dd($images);


      if ($saved) {
        return redirect()->route('apartments.show', $newApartment);
      }
  }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $user = User::where('id', Auth::id())->get();
        // dd($user);
        $optionals = Optional::all();
        $sponsors = Sponsor::all();
        $images= Image::where('apartment_id', $apartment->id)->get();
        if (Auth::id() == $apartment->user_id) {
            $proprietario = true;
        } else {
            $proprietario = false;
            // incremento contatore visite
            $newVisit = new Visit;
            $newVisit->apartment_id = $apartment->id;
            $newVisit->data_visita = Carbon::now();
            $newVisit->save();
        }
        $messages= Message::where([['apartment_id', $apartment->id],['user_id', Auth::id()]])->get();
        $sponsorizzato= SponsorApartment::where('apartment_id', $apartment->id)->pluck('data_fine')->sortDesc()->first();
        $ora = Carbon::now();
        $ultimaDataFine = Carbon::parse(SponsorApartment::where('apartment_id',$apartment->id)->pluck('data_fine')->sortDesc()->first());
        if($ultimaDataFine->greaterThan($ora)){
            $sponsorizzato = $ultimaDataFine;
        } else {
            $sponsorizzato = null;
        };
        return view('admin.show',compact('apartment', 'optionals', 'images', 'proprietario', 'user', 'messages', 'sponsors', 'sponsorizzato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $optionals = Optional::all();
        $images= Image::where('apartment_id', $apartment->id)->get();
        $numImages = count(Image::where('apartment_id',$apartment->id)->get());
        $immaginiRimanenti= 5 - $numImages;
        return view('admin.edit',compact('apartment','optionals', 'images', 'immaginiRimanenti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request->all();
        $vecchioTitolo =  $apartment->titolo;
        // aggiunta controlli
        $request->validate([
          'titolo' => 'required|min:5|max:100',
          'descrizione' => 'required|min:10|max:500',
          'numero_stanze' => 'required|integer|min:1|max:20',
          'numero_letti' => 'required|integer|min:1|max:40',
          'numero_bagni' => 'required|integer|min:1|max:20',
          'mq' => 'nullable|integer|min:15|max:1000',
          'indirizzo' => 'required|min:5|max:255'
        ]);
        $data['user_id'] = Auth::id();
        $data['slug']= Str::finish(Str::slug($data['titolo'],'-'), rand(1,10000));
        //nuova istanza
        $data['updated_at']=Carbon::now('Europe/Rome');
        $saved = $apartment->update($data);
        $numImages = count(Image::where('apartment_id',$apartment->id)->get());
        $immaginiRimanenti = 5 - $numImages;
        for ($i=0; $i <= $immaginiRimanenti ; $i++) {
            if (!empty($data['img'.$i])) {
              // salviamo l'img inserita nel form nella cartella storage/app/public/images
              $data['img'.$i] = Storage::disk('public')->put('images',$data['img'.$i]);
              // creiamo una nuova istanza della classe images
              $newImage = New Image;
              // Compiliamo i dati della colonne immagine e apartment_id
              $newImage->immagine = $data['img'.$i];
              $newImage->apartment_id = $apartment->id;
              // Salviamo l'immagine nel database
              $newImage->save();
            }
        }

        if(!empty($data['optionals'])){
        $apartment->optionals()->sync($data['optionals']);
        }else {
        $apartment->optionals()->detach();
        }

        if ($saved) {
          return redirect()->route('apartments.show', $apartment->id)->with('status', "Hai modificato l'appartamento: " . $vecchioTitolo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $immagini = [];

            $query = Image::where('apartment_id', $apartment->id)->pluck('immagine');
            if (count($query) != 0) {
                $immagini = [...$immagini,...$query];
            }
            foreach ($immagini as $immagine) {
                Storage::disk('public')->delete($immagine);
            }

      $apartment->delete();
        return redirect()->route('apartments.index')->with('status',"Hai cancellato l'appartamento: ". $apartment->titolo);

    }
}
