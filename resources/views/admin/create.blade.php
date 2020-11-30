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
<h1 class="text-center text-primary mt-3">Nuovo appartamento</h1>
<form action="{{route('apartments.store')}}" method="post" enctype="multipart/form-data" class="card col-6 mx-auto pt-3 mt-3 mb-4">
  @csrf
  @method('POST')
  <label for="titolo">Titolo:</label>
  <input type="text" name="titolo" placeholder="Inserisci il titolo" value="{{old('titolo')}}">
  @for ($i=0; $i < 5; $i++)
    <label for="img{{$i+1}}">Immagine</label>
    <input type="file" name="img{{$i+1}}" accept="image/*">
    @endfor
    <label for="descrizione">Descrizione:</label>
    <textarea name="descrizione" rows="8" cols="80" placeholder="Inserisci il testo">{{old('descrizione')}}</textarea>
    <label for="numero_stanze">Numero Stanze:</label>
    <input type="number" name="numero_stanze" placeholder="Inserisci il numero_stanze" value="{{old('numero_stanze')}}">
    <label for="numero_letti">Numero Letti:</label>
    <input type="number" name="numero_letti" placeholder="Inserisci il numero_letti" value="{{old('numero_letti')}}">
    <label for="numero_bagni">Numero Bagni:</label>
    <input type="number" name="numero_bagni" placeholder="Inserisci il numero_bagni" value="{{old('numero_bagni')}}">
    <label for="mq">Metri Quadrati:</label>
    <input type="number" name="mq" placeholder="Inserisci i metri Quadrati" value="{{old('mq')}}">
    {{-- fare check con algolia --}}

     <label for="indirizzo">Indirizzo:</label>
    <div id="app">
        <input-create-indirizzo>
        </input-create-indirizzo>
    </div>
    <div class="mt-3">
      @foreach ($optionals as $optional)
       <div class="col-lg-4 pl-0">
         <label for="optional">{{$optional->nome}}</label>
         <input type="checkbox" name="optionals[]" value="{{$optional->id}}">
       </div>
     @endforeach
     </div>


    <input type="submit" class="btn btn-primary mb-3" value="Invia">
    {{-- <div> --}}
      {{-- @foreach ($tags as $tag)
        <label for="tag">{{$tag->name}}</label>
      <input type="checkbox" name="tags[]" value="{{$tag->id}}">
      @endforeach --}}
    {{-- </div> --}}
</form>
@endsection
