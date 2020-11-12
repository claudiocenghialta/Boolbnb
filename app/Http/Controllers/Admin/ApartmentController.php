<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
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
      //aggiunta controlli
      // $request->validate([
      //   'title' => 'required|min:5|max:100',
      //   'body' => 'required|min:5|max:500'
      // ]);
      $data['user_id'] = Auth::id();
      $data['slug']=Str::slug($data['titolo'],'-');
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
        return redirect()->route('apartments.index');
      }
  }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
