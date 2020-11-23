{{-- serve route e api controller --}}
@extends('layouts.app')

@section('content')
  <div id="app">
    <input-search-indirizzo>

    </input-search-indirizzo>
  </div>
  <div class="elenco">
    @foreach ($apartments as  $apartment)
      <div class="card mb-3">
      <img class="card-img-top" src="{{ !empty($apartment->immagini[0]) ? (substr($apartment->immagini[0],0,4)=='http') ?($apartment->immagini[0]) : (asset('storage/'.$apartment->immagini[0])) : 'placeholders/placeholder-apartment.jpg'}}" alt="Card image cap">
      <div class="card-body">
        {{-- AGGIUSTATA SESSION --}}
        @guest
          <h5 class="card-title"><a href="{{ route('guest.apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
        @else
          <h5 class="card-title"><a href="{{ route('apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
        @endguest
        {{-- NON FUNZIONA PIU LA SESSION! andare sulla home chiude la session quindi if è sempre falso--}}
        {{-- @if (session('status'))
              <h5 class="card-title"><a href="{{ route('apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
            @else
              <h5 class="card-title"><a href="{{ route('guest.apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
        @endif --}}
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
@endsection
