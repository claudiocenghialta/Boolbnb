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
  <form action="{{route('apartments.update', $apartment->id)}}" method="post"  enctype="multipart/form-data" class="card col-5 mx-auto">
  @csrf
  @method('PATCH')
    <label for="titolo">Titolo:</label>
      <input type="text" name="titolo" value="{{$apartment->titolo}}" placeholder="Inserisci il titolo">
    <label for="img">Immagine di copertina</label>
      <input type="file" name="img" accept="image/*">
      @foreach ($images as $img)
          <img class="img-fluid rounded mx-auto"
              src="{{(substr($img->immagine,0,4)=='http') ?($img->immagine) : (asset('storage/'.$img->immagine))}}" alt="{{$apartment->titolo}}">
      @endforeach
    <label for="descrizione">Descrizione:</label>
      <textarea name="descrizione" rows="8" cols="80"  placeholder="Inserisci il testo">{{$apartment->descrizione}}</textarea>
    <label for="numero_stanze">N Stanze:</label>
      <input type="number" name="numero_stanze" value="{{$apartment->numero_stanze}}" placeholder="Inserisci il numero_stanze">
    <label for="numero_letti">N Letti:</label>
      <input type="number" name="numero_letti" value="{{$apartment->numero_letti}}" placeholder="Inserisci il numero_letti">
    <label for="numero_bagni">N Bagni:</label>
      <input type="number" name="numero_bagni" value="{{$apartment->numero_bagni}}" placeholder="Inserisci il numero_bagni">
    <label for="mq">Metri Quadrati:</label>
      <input type="number" name="mq" value="{{$apartment->mq}}" placeholder="Inserisci i metri Quadrati">
    {{-- fare check con algolia --}}
    <label for="indirizzo">Indirizzo:</label>
      <input type="text" name="indirizzo" value="{{$apartment->indirizzo}}" placeholder="Inserisci il indirizzo">
     @foreach ($optionals as $optional)
        <label for="optional">{{$optional->nome}}</label>
        <input type="checkbox" name="optionals[]" value="{{$optional->id}}"{{($apartment->optionals->contains($optional->id) ? 'checked' : '')}}>
    @endforeach


    <input type="submit"class="btn btn-primary" value="Salva">
    <div>
      {{-- @foreach ($tags as $tag)
        <label for="tag">{{$tag->name}}</label>
        <input type="checkbox" name="tags[]" value="{{$tag->id}}">
      @endforeach --}}
    </div>
  </form>
@endsection
