<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Message;
use App\User;
use App\Apartment;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::id();
        $apartments = Apartment::where('user_id', Auth::id())->get();
        foreach ($apartments as $apartment){
            // estraggo tutti i messaggi ricevuti per ogni appartamento
            $apartment['messaggi'] = $apartment->messages()->get();
            // foreach ($apartment['messaggi'] as $message) {
            //     $message['mailMitt'] = $message->user()->pluck('email')->first();
            //     // $messagesReceived[]=$message;
            // }
        }
        // dd($apartments);
        return view('admin.messages.index', compact('apartments'));
    }

    public function sent()
    {
        $messages = Message::where('user_id', Auth::id())->get();
        
        return view('admin.messages.sent', compact('messages'));
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
        $data= $request->all();
        $request->validate([
          'messaggio' => 'required|min:1|max:255',
        ]);
        $data['user_id'] = Auth::id();
        $newMessage = New Message;
        $newMessage->fill($data);
        $newMessage->save();

        return redirect()->route('apartments.show', $newMessage->apartment_id);
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
    public function destroy($id)
    {
        //
    }
}
