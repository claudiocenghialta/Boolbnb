

@extends('layouts.app')

@section('content')

  <div id="app">

        <input-search-indirizzo>
        </input-search-indirizzo>
        <input type="hidden" id="c-lat" value="{{$lat}}"  class="form-control" placeholder="?" />
        <input type="hidden" id="c-lng" value="{{$lng}}"  class="form-control" placeholder="?" />
        <label for="numero_stanze">Numero di stanze</label>
        <input type="number" id="numero_stanze" name="numero_stanze" value="">
        <label for="numero_letti">Numero di letti</label>
        <input type="number" id="numero_letti" name="numero_letti" value="">
        <label for="numero_bagni">Numero di Bagni</label>
        <input type="number" id="numero_bagni" name="numero_bagni" value="">
        <label for="">Modifica il raggio di ricerca</label>
        <input type="number" id="radius" name="raggioKm" value="20">
        @foreach ($optionals as $optional)
        <label for="optional">{{$optional->nome}}</label>
        <input type="checkbox"  name="optionals[]" value="{{$optional->id}}">
        @endforeach
        <button type="button" id="cerca" name="button">Cerca</button>

        <label for=""></label>

  </div>




  <div class="elenco">
    @foreach ($apartments as  $apartment)
      <div class="card mb-3">
      <img class="card-img-top" src="{{ !empty($apartment->immagini[0]) ? (substr($apartment->immagini[0],0,4)=='http') ?($apartment->immagini[0]) : (asset('storage/'.$apartment->immagini[0])) : 'placeholders/placeholder-apartment.jpg'}}" alt="Card image cap">
      <div class="card-body">
        {{-- SESSION --}}
        @guest
          <h5 class="card-title"><a href="{{ route('guest.apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
        @else
          <h5 class="card-title"><a href="{{ route('apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
        @endguest

        @foreach ($optionals as $optional)
        <label for="optional">{{$optional->nome}}</label>
        <input type="checkbox" name="optionals[]" value="{{$optional->id}}"
            {{($apartment->optionals->contains($optional->id) ? 'checked' : '')}} disabled>
        @endforeach
        <p class="card-text">{{ $apartment->descrizione }}</p>
        <p class="card-text"><small class="text-muted"></small>Sponsorizzato: {{ $apartment->sponsorizzato }}
        </p>
        <p class="card-text"><small class="text-muted">Ultimo aggiornamento: {{ $apartment->updated_at->format('d-M-Y - h:m') }} </small></p>

      </div>
    </div>
    @endforeach



  </div>
  @include('handlebar/template')



@endsection
