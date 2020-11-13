<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
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
      $apartments = Apartment::all();

      return view('admin.index', compact('apartments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
      $data['slug']= Str::finish(Str::slug($data['titolo'],'-'), $data['user_id']);
      //nuova istanza
      $newApartment = New Apartment;
      //get imgs to put in public folder images
      // if (!empty($data['img'])) {
      //   $data['img'] = Storage::disk('public')->put('images',$data['img']);
      // }
      //popolo
      $newApartment->fill($data);
      //salvo
      $saved = $newApartment->save();
      //collego i tags
      // $newApartment->tags()->attach($data['tags']);

      if ($saved) {
        return redirect()->route('apartments.show');
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
        // $apartment = Apartment::find($id);
        return view('admin.show',compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('admin.edit',compact('apartment'));
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
        $data['slug']= Str::finish(Str::slug($data['titolo'],'-'), $data['user_id']);
        //nuova istanza
        $data['updated_at']=Carbon::now('Europe/Rome');
        $saved = $apartment->update($data);


        //get imgs to put in public folder images
        // if (!empty($data['img'])) {
        //   $data['img'] = Storage::disk('public')->put('images',$data['img']);
        // }
        //popolo
        // $newApartment->fill($data);
        //salvo
        // $saved = $newApartment->save();
        //collego i tags
        // $newApartment->tags()->attach($data['tags']);

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
      $apartment->delete();
        return redirect()->route('apartments.index')->with('status',"Hai cancellato l'appartamento ". $apartment->id);
    }
}
