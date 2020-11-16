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
<a href="{{ route('apartments.edit', $apartment->id )}}">Edit</a>
<form action="{{ route('apartments.destroy', $apartment->id )}}" method="post">
  @csrf
  @method('DELETE')
  <button type="submit" name="button" class="btn btn-danger">Delete</button>
</form>
@endsection
{{-- aggiungere optionals --}}
{{-- aggiungere sponsorizzazione e statistiche --}}
