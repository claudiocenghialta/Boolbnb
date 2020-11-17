@extends('layouts.app')
@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status')}}
    </div>
@endif
<p>Titolo:{{$apartment->titolo}}</p>
@foreach ($images as $img)
    <img class="img-fluid rounded mx-auto"
        src="{{(substr($img->immagine,0,4)=='http') ?($img->immagine) : (asset('storage/'.$img->immagine))}}" alt="{{$apartment->titolo}}">

@endforeach

<p>Descrizione:{{$apartment->descrizione}}</p>
<p>N Stanze:{{$apartment->numero_stanze}}</p>
<p>N Letti:{{$apartment->numero_letti}}</p>
<p>N Bagni:{{$apartment->numero_bagni}}</p>
<p>Metri Quadrati:{{$apartment->mq}}</p>
<p>Indirizzo:{{$apartment->indirizzo}}</p>
@foreach ($optionals as $optional)
   <label for="optional">{{$optional->nome}}</label>
   <input type="checkbox" name="optionals[]" value="{{$optional->id}}"{{($apartment->optionals->contains($optional->id) ? 'checked' : '')}} disabled>
@endforeach
@if ($proprietario)
    {{-- Sezione per proprietario appartamento --}}
    <a href="{{ route('apartments.edit', $apartment->id )}}">Edit</a>
    <form action="{{ route('apartments.destroy', $apartment->id )}}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" name="button" class="btn btn-danger">Delete</button>
    </form>

    {{-- aggiungere sponsorizzazione e statistiche --}}
    
@else
    {{-- Sezione per utente non proprietario --}}
    @foreach ($user as $value)
        <h3>Cronologia Messaggi</h3>
        <ul>
            @foreach ($messages as $message)
                <li>{{$message->messaggio}} - {{$message->created_at}}</li>
            @endforeach
        </ul>
        <form action="{{route('messages.store')}}" method="post"  enctype="multipart/form-data" class="card col-5 mx-auto">
            <h3>Contatta il Proprietario</h3>
        @csrf
        @method('POST')
        @if (empty($value->avatar))
            <img class="img-fluid rounded mx-auto"
             src="{{asset('storage/images/placeholder_avatar.jpeg')}}" alt="avatar">
        @else
            <img class="img-fluid rounded mx-auto"
                src="{{(substr($value->avatar,0,4)=='http') ?($value->avatar) : (asset('storage/'.$value->avatar))}}" alt="{{$value->nome. '-' . $value->cognome}}">
        @endif
            <label for="nome">Nome:</label>
              <input type="text" name="nome" value="{{$value->nome}}" placeholder="Inserisci il nome" disabled>
            <label for="email">E-mail:</label>
              <input type="text" name="email" value="{{$value->email}}" disabled>
              <label for="messaggio">Messaggio:</label>
              <textarea name="messaggio" rows="8" cols="80" placeholder="Inserisci il testo"></textarea>
              <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
              <input type="submit"class="btn btn-primary" value="Salva">
         </form>
    @endforeach

@endif




@endsection
