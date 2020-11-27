

@extends('layouts.app')

@section('content')
    <div class="main">


    <div id="app" class="searchbar row col-12 col-md-3">
        <div class="container">
            <div class="col-12 pl-3">
                <input-search-indirizzo>
                </input-search-indirizzo>
            </div>
        </div>
            <div class="container pt-2">
            <div class="searchbar-sx">
                <input type="hidden" id="c-lat" value="{{$lat}}"  class="form-control" placeholder="?" />
                <input type="hidden" id="c-lng" value="{{$lng}}"  class="form-control" placeholder="?" />
                <div class="col-12 search-optionals">
                    @foreach ($optionals as $optional)
                    <div class="optional-search">
                        <input type="checkbox"  name="optionals[]" value="{{$optional->id}}">
                        <label for="optional">{{$optional->nome}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 searchbar-dx row">
                <div class="col-3 col-md-12 form-group">
                    <label class="" for="numero_stanze">Numero di stanze</label>
                    <input class="form-control" type="number" id="numero_stanze" name="numero_stanze" value="">
                </div>
                <div class="col-3 col-md-12 form-group">
                    <label class="" for="numero_letti">Numero di letti</label>
                    <input class="form-control" type="number" id="numero_letti" name="numero_letti" value="">
                </div>
                <div class="col-3 col-md-12 form-group">
                    <label class="" for="numero_bagni">Numero di Bagni</label>
                    <input class="form-control" type="number" id="numero_bagni" name="numero_bagni" value="">
                </div>
                <div class="col-3 col-md-12 form-group">
                    <label class="" for="">Raggio di ricerca</label>
                    <input class="form-control" type="number" id="radius" name="raggioKm" value="20">
                </div>
                <div class="col-4 col-md-8 offset-md-2 offset-4 form-group">
                <button class="btn btn-outline-success button-search col-12" type="button" id="cerca" name="button">Cerca</button>
                </div>


            </div>
        </div>


    </div>

    <div class="container container-elenco col-12 col-md-9">
        <div class="card-deck p-3 elenco">

          @foreach ($apartments as  $apartment)

                <div class="card card-search mb-2">
                <img class="card-img-top" src="{{ !empty($apartment->immagini[0]) ? (substr($apartment->immagini[0],0,4)=='http') ?($apartment->immagini[0]) : (asset('storage/'.$apartment->immagini[0])) : 'placeholders/placeholder-apartment.jpg'}}" alt="Card image cap" width="auto" height="180px">
                <div class="card-body">
                  {{-- SESSION --}}
                  @guest
                    <h5 class="card-title"><a href="{{ route('guest.apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
                  @else
                    <h5 class="card-title"><a href="{{ route('apartments.show', $apartment->id )}}">{{ $apartment->titolo }}</a></h5>
                  @endguest
                  <div class="optional-div">
                      @foreach ($optionals as $optional)
                          <div class="b"{{($apartment->optionals->contains($optional->id) ? '' : 'hidden')}}>
                              <i class="fas fa-check text-info"></i>
                              <span class="optional" >{{$optional->nome}}</span>
                          </div>
                      @endforeach
                  </div>

                  <div class="decrizione-div">
                      <p class="card-text testo-descrizione">{{ $apartment->descrizione }}</p>
                  </div>
                  <p class="card-text"><small class="text-muted">Ultimo aggiornamento: {{ $apartment->updated_at->format('d/m/Y, h:m:s') }} </small></p>

                </div>
              </div>


          @endforeach



        </div>
    </div>
</div>
@guest
    @include('handlebar/gtemplate')
@else
    @include('handlebar/atemplate')
@endguest
 



@endsection
