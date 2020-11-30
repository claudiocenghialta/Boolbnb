@extends('layouts.app')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<h1 class="text-center text-primary mt-3">Modifica l'appartamento</h1>
{{-- IMMAGINI SOTTO IL TITOLO --}}
{{-- <div class="card-deck mx-auto justify-content-center">
  @foreach ($images as $img)
  <div class="card col-lg-4">
    <img class="img-fluid rounded mx-auto mt-3"
      src="{{(substr($img->immagine,0,4)=='http') ?($img->immagine) : (asset('storage/'.$img->immagine))}}"
      alt="{{$apartment->titolo}}">
    <form action="{{ route('images.destroy', $img->id )}}" method="post" class="text-center">
      @csrf
      @method('DELETE')
      <button type="submit" name="button" class="btn btn-alert btn-delete-alert text-danger">Delete</button>
    </form>
  </div>
  @endforeach
</div> --}}
<form action="{{route('apartments.update', $apartment->id)}}" method="post" enctype="multipart/form-data"
  class="card col-sm-6 col-lg-6 mx-auto mb-4 pt-3 pb-3 mt-3">
  @csrf
  @method('PATCH')
  <label for="titolo">Titolo:</label>
  <input type="text" name="titolo" value="{{$apartment->titolo}}" placeholder="Inserisci il titolo">
  @if ($immaginiRimanenti != 0)
  @for ($i=$immaginiRimanenti; $i > 0; $i--) <label for="img{{$i+1}}">{{($i == 5)? 'Immagine di copertina' : 'Immagine'}}</label>
    <input type="file" name="img{{$i+1}}" accept="image/*">
    @endfor
    @else
    <label for="img">Immagine</label>
    <div class="alert alert-danger">
      Hai già caricato tutte le immagini a disposizione!
    </div>
    @endif

    <label for="descrizione">Descrizione:</label>
    <textarea name="descrizione" rows="8" cols="80"
      placeholder="Inserisci il testo">{{$apartment->descrizione}}</textarea>
    <label for="numero_stanze">N Stanze:</label>
    <input type="number" name="numero_stanze" value="{{$apartment->numero_stanze}}"
      placeholder="Inserisci il numero_stanze">
    <label for="numero_letti">N Letti:</label>
    <input type="number" name="numero_letti" value="{{$apartment->numero_letti}}"
      placeholder="Inserisci il numero_letti">
    <label for="numero_bagni">N Bagni:</label>
    <input type="number" name="numero_bagni" value="{{$apartment->numero_bagni}}"
      placeholder="Inserisci il numero_bagni">
    <label for="mq">Metri Quadrati:</label>
    <input type="number" name="mq" value="{{$apartment->mq}}" placeholder="Inserisci i metri Quadrati">
    {{-- fare check con algolia --}}
    <label for="indirizzo">Indirizzo:</label>

      <div id="app">
        <input-edit-indirizzo >
      </input-edit-indirizzo>
      </div>
      <div class="mt-3">
       @foreach ($optionals as $optional)
         <div class="col-lg-4 pl-0">
            <label for="optional">{{$optional->nome}}</label>
            <input type="checkbox" name="optionals[]" value="{{$optional->id}}"{{($apartment->optionals->contains($optional->id) ? 'checked' : '')}}>
         </div>
       @endforeach
      </div>
    <input type="submit" class="btn btn-primary" value="Salva">
</form>
<div class="card-deck mx-auto justify-content-center">
  @foreach ($images as $img)
  <div class="card col-lg-4">
    <img class="img-fluid rounded mx-auto mt-3"
      src="{{(substr($img->immagine,0,4)=='http') ?($img->immagine) : (asset('storage/'.$img->immagine))}}"
      alt="{{$apartment->titolo}}">
    <form action="{{ route('images.destroy', $img->id )}}" method="post" class="text-center">
      @csrf
      @method('DELETE')
      <button type="submit" name="button" class="btn btn-alert btn-delete-alert text-danger">Delete</button>
    </form>
  </div>
  @endforeach
</div>

@endsection
