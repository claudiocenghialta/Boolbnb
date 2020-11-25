@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="app" class="mb-5">
                <form class="form-search" action="{{route('search')}}" method="get">
                  <input-search-indirizzo>
                  </input-search-indirizzo>
                  <input  type="submit" name="" value="cerca">
                </form>


            </div>
            {{-- prova homepage --}}
          @foreach ($apartments as $apartment)
            <div class="card mb-3">
            <img class="card-img-top" src="{{ !empty($apartment->immagine) ? (substr($apartment->immagine,0,4)=='http') ?($apartment->immagine) : (asset('storage/'.$apartment->immagine)) : 'placeholders/placeholder-apartment.jpg'}}" alt="Card image cap">
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
              <p class="card-text"><small class="text-muted">Ultimo aggiornamento: {{ $apartment->updated_at->format('d-M-Y - H:m') }} </small></p>

            </div>
          </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
