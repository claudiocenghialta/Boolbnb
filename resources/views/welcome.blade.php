@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid jumbotron-welcome">
  <div class="container">
    {{-- <div class="col-lg-12"> --}}

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
    {{-- </div> --}}
  </div>
</div>

{{-- <div class="container"> --}}
<section id="vetrina" class="pb-5">
  <div class="container">
    <h2 class="text-primary">Vetrina</h2>
  </div>
  <div class="card-deck container-card-welcome">

    {{-- prova homepage --}}
    @foreach ($apartments as $apartment)
    <div class="card mb-3 mt-3 card-welcome">
      <img class="card-img-top"
        src="{{ !empty($apartment->immagine) ? (substr($apartment->immagine,0,4)=='http') ?($apartment->immagine) : (asset('storage/'.$apartment->immagine)) : 'placeholders/placeholder-apartment.jpg'}}"
        alt="Card image cap">
      <div class="card-body">
        {{-- SESSION --}}
        @guest
        <h4 class="card-title"><a
            href="{{ route('guest.apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a>
        </h4>
        @else
        <h4 class="card-title"><a href="{{ route('apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a>
        </h4>
        @endguest
        <div class="container row mb-3">
          @foreach($apartment->optionals as $optional)
          <div class="optional-container mr-2 d-inline-block">
            <i class="fas fa-check text-info"></i>
            <label for="optional">{{$optional->nome}}</label>
          </div>
          @endforeach
        </div>
        <p class="card-text"><i class="fas fa-map-marker-alt text-primary"></i> {{ $apartment->indirizzo }}</p>
        {{-- <p class="card-text">{{ $apartment->descrizione }}</p> --}}
        <p class="card-text"><small class="text-muted"></small>Sponsorizzato: {{ $apartment->sponsorizzato }}
        </p>
        <p class="card-text"><small class="text-muted">Ultimo aggiornamento:
            {{ $apartment->updated_at->format('d-M-Y - H:m') }} </small></p>

      </div>
    </div>
    @endforeach
  </div>
  {{-- </div> --}}

</section>

<section id="host" class="mt-5 pt-5 pb-5 jumbotron jumbotron-fluid">

  <div class="container d-flex">
    <div class="col-8 text-white">
      <h1 class="display-4">Diventa un Host</h1>
      <p class="lead">Inizia a guadagnare dai tuoi appartamenti</p>
    </div>
    <div class="col-4 host-image-container">
      <img src="https://images.pexels.com/photos/128299/pexels-photo-128299.jpeg" class="card-img"
        alt="Diventa un host">
    </div>
  </div>

</section>

<section id="cities" class="mt-5 pt-5 pb-5">
  <div class="container">
    <h2 class="text-primary">Città</h2>
  </div>
</section>

@endsection