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
  <form action="{{route('apartments.store')}}" method="post"  enctype="multipart/form-data" class="card col-5 mx-auto">
  @csrf
  @method('POST')
    <label for="titolo">Titolo:</label>
      <input type="text" name="titolo" placeholder="Inserisci il titolo">
    {{-- <label for="img">Immagine:</label>
      <input type="file" name="img" accept="image/*"> --}}
    <label for="descrizione">Descrizione:</label>
      <textarea name="descrizione" rows="8" cols="80" placeholder="Inserisci il testo"></textarea>
    <label for="numero_stanze">N Stanze:</label>
      <input type="number" name="numero_stanze" placeholder="Inserisci il numero_stanze">
    <label for="numero_letti">N Letti:</label>
      <input type="number" name="numero_letti" placeholder="Inserisci il numero_letti">
    <label for="numero_bagni">N Bagni:</label>
      <input type="number" name="numero_bagni" placeholder="Inserisci il numero_bagni">
    <label for="mq">Mq:</label>
      <input type="number" name="mq" placeholder="Inserisci il mq">
    {{-- fare check con algolia --}}
    <label for="indirizzo">Indirizzo:</label>
      <input type="text" name="indirizzo" placeholder="Inserisci il indirizzo">


    <input type="submit"class="btn btn-primary" value="Invia">
    <div>
      {{-- @foreach ($tags as $tag)
        <label for="tag">{{$tag->name}}</label>
        <input type="checkbox" name="tags[]" value="{{$tag->id}}">
      @endforeach --}}
    </div>
  </form>
@endsection
