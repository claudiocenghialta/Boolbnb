@extends('layouts.app')
@section('content')

<p>Titolo:{{$apartment->titolo}}</p>
{{-- prova fix immagini --}}
@if ($images->count() == 0)
<img class="img-fluid rounded mx-auto" src="{{asset('placeholders/placeholder-apartment.jpg')}}" alt="placeholder">
@else
@foreach ($images as $img)
<img class="img-fluid rounded mx-auto"
    src="{{(substr($img->immagine,0,4)=='http') ?($img->immagine) : (asset('storage/'.$img->immagine))}}" alt="no">
@endforeach
@endif
{{-- fino a qui  --}}

{{-- @foreach ($images as $img)
<img class="img-fluid rounded mx-auto"
    src="{{ empty($img->immagine) ? asset('placeholders/placeholder-apartment.jpg') : ( (substr($img->immagine,0,4)=='http') ? ($img->immagine) : (asset('storage/'.$img->immagine)) )}}"
alt="{{$apartment->titolo}}">
@endforeach --}}

<p>Descrizione:{{$apartment->descrizione}}</p>
<p>N Stanze:{{$apartment->numero_stanze}}</p>
<p>N Letti:{{$apartment->numero_letti}}</p>
<p>N Bagni:{{$apartment->numero_bagni}}</p>
<p>Metri Quadrati:{{$apartment->mq}}</p>
<p>Indirizzo:{{$apartment->indirizzo}}</p>
@foreach ($optionals as $optional)
<label for="optional">{{$optional->nome}}</label>
<input type="checkbox" name="optionals[]" value="{{$optional->id}}"
    {{($apartment->optionals->contains($optional->id) ? 'checked' : '')}} disabled>
@endforeach
@if ($proprietario)
{{-- Sezione per proprietario appartamento --}}
<a href="{{ route('apartments.edit', $apartment->id )}}">Edit</a>
<form action="{{ route('apartments.destroy', $apartment->id )}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" name="button" class="btn btn-danger">Delete</button>
</form>

{{-- aggiungere sponsorizzazione --}}
<label for="sponsor">Sponsorizza</label>

<form action="{{-- {{route('sponsors.store', )}} --}}" method="post" enctype="multipart/form-data"
    class="card col-5 mx-auto">
    <select id="sponsor" name="id">
        <option value="0">Seleziona una opzione</option>
        @foreach ($sponsors as $sponsor)
        <option value="{{$sponsor->id}}">{{$sponsor->nome}} - € {{$sponsor->costo}}</option>
        @endforeach
    </select>
    <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
    @csrf
    @method('POST')
    <input type="submit" class="btn btn-primary" value="Acquista Sponsorizzazione">


    {{-- aggiungere controllo javascript, se value == 0 allora il bottone non deve fare nulla
        se no deve fare chiamata API di braintree
        A) se chiamata ad api braintree ritorna "pagamento ok" (true/false)
            allora facciamo chiamata api a sponsors.store, passandogli il value dell'option selezionato (campo tabella sponsor_id), passo anche l'apartment_id
        B) se false, ritorna alla show dell'appartamento con messaggio 'pagamento non effettuato'

        http://127.0.0.1:8000/api/sponsor?apartment_id=5&sponsor_id=1

            --}}
</form>
{{-- aggiungere statistiche --}}

{{-- Sezione per utente non proprietario --}}
@else

<div id="app">
    <map-show v-bind:lat="{{$apartment->lat}}" v-bind:lng="{{$apartment->lng}}">
    </map-show>
</div>

{{-- Sezione per utente non proprietario --}}

@if (isset($user))
@foreach ($user as $value)
@if ($messages->count() > 0)
<h3>Cronologia Messaggi</h3>
<ul>
    @foreach ($messages as $message)
    <li>{{$message->messaggio}} - {{$message->created_at}}</li>
    @endforeach
</ul>
@endif
<form action="{{route('messages.store')}}" method="post" enctype="multipart/form-data" class="card col-5 mx-auto">
    <h3>Contatta il Proprietario</h3>
    @csrf
    @method('POST')
    @if (empty($value->avatar))
    <img class="img-fluid rounded mx-auto" src="{{asset('placeholders/placeholder_avatar.svg')}}" alt="avatar">
    @else
    <img class="img-fluid rounded mx-auto"
        src="{{(substr($value->avatar,0,4)=='http') ?($value->avatar) : (asset('storage/'.$value->avatar))}}"
        alt="{{$value->nome. '-' . $value->cognome}}">
    @endif
    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="{{$value->nome}}" placeholder="Inserisci il nome" disabled>
    <label for="email">E-mail:</label>
    <input type="text" name="email" value="{{$value->email}}" disabled>
    <label for="messaggio">Messaggio:</label>
    <textarea name="messaggio" rows="8" cols="80" placeholder="Inserisci il testo"></textarea>
    <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
    <input type="submit" class="btn btn-primary" value="Salva">
</form>
@endforeach
@else
<a class="btn btn-primary" href="{{ route('register')}}">
    Registrati per contattare il proprietario
</a>
@endif

@endif




@endsection
