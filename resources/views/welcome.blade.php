@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid jumbotron-welcome">
  <div class="container">
    <div class="col-lg-12">

      <h1 class="col-sm-12 display-4 pl-0 titolo-jumbo">Cerca il tuo covo</h1>
      <div id="app" class="mb-5">
        <form class="" action="{{route('search')}}" method="get">
          <div class="form-group row">
            <div class="col-10 col-md-8">
              <input-search-indirizzo>
              </input-search-indirizzo>
            </div>
            <input type="submit" class="btn btn-primary" name="" value="Vai">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container">

  <div class="row justify-content-center">
    <div class="col-md-8">

      {{-- prova homepage --}}
      @foreach ($apartments as $apartment)
      <div class="card mb-3">
        <img class="card-img-top"
          src="{{ !empty($apartment->immagine) ? (substr($apartment->immagine,0,4)=='http') ?($apartment->immagine) : (asset('storage/'.$apartment->immagine)) : 'placeholders/placeholder-apartment.jpg'}}"
          alt="Card image cap">
        <div class="card-body">
          {{-- SESSION --}}
          @guest
          <h5 class="card-title"><a
              href="{{ route('guest.apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
          @else
          <h5 class="card-title"><a href="{{ route('apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a>
          </h5>
          @endguest

          @foreach ($optionals as $optional)
          <label for="optional">{{$optional->nome}}</label>
          <input type="checkbox" name="optionals[]" value="{{$optional->id}}"
            {{($apartment->optionals->contains($optional->id) ? 'checked' : '')}} disabled>
          @endforeach
          <p class="card-text">{{ $apartment->descrizione }}</p>
          <p class="card-text"><small class="text-muted"></small>Sponsorizzato: {{ $apartment->sponsorizzato }}
          </p>
          <p class="card-text"><small class="text-muted">Ultimo aggiornamento:
              {{ $apartment->updated_at->format('d-M-Y - H:m') }} </small></p>

        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection