<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\User;
use App\Apartment;
use App\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $request->validate([
        'nome' => 'required|min:5|max:100',
        'cognome' => 'max:100',
      ]);

        if(!empty($data['avatar'])){
            if (!empty($user->avatar)) {
                Storage::disk('public')->delete($user['avatar']);
            }
            $data['avatar'] = Storage::disk('public')->put('images',$data['avatar']);
        }
        $data['updated_at'] = Carbon::now('Europe/Rome');
        $saved = $user->update($data);
        if ($saved) {
            return redirect()->route('users.show',$user->id)->with('status','Hai modificato correttamente i dati');
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $apartments = Apartment::where('user_id', $user->id)->get();

        $immagini = [];
        foreach ($apartments as $apartment) {
            $query = Image::where('apartment_id', $apartment->id)->pluck('immagine');
            if (count($query) != 0) {
                $immagini = [...$immagini,...$query];
            }

        }
        foreach ($immagini as $immagine) {
            Storage::disk('public')->delete($immagine);
        }
            Storage::disk('public')->delete($user->avatar);
        $user->delete();
        return view('welcome');
    }
}
