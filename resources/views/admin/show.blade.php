@extends('layouts.app')
@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status')}}
    </div>
@endif
<p>Titolo:{{$apartment->titolo}}</p>
{{-- <p>Immagine:{{$apartment->titolo}}</p> --}}
<p>Descrizione:{{$apartment->descrizione}}</p>
<p>N Stanze:{{$apartment->numero_stanze}}</p>
<p>N Letti:{{$apartment->numero_letti}}</p>
<p>N Bagni:{{$apartment->numero_bagni}}</p>
<p>Metri Quadrati:{{$apartment->mq}}</p>
<p>Indirizzo:{{$apartment->indirizzo}}</p>
<a href="{{ route('apartments.edit', $apartment->id )}}">Edit</a>
<form action="{{ route('apartments.destroy', $apartment->id )}}" method="post">
  @csrf
  @method('DELETE')
  <button type="submit" name="button" class="btn btn-danger">Delete</button>
</form>
@endsection
{{-- aggiungere optionals --}}
{{-- aggiungere sponsorizzazione e statistiche --}}
