@extends('layouts.app')

@section('content')
<div class="container">
            
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged OUT!') }}
                </div>
            </div> --}}
            <div id="app" class="mb-5">
                <input-search-indirizzo>
                </input-search-indirizzo>
                {{-- <Prova>
                </Prova> --}}
            </div>
            {{-- prova homepage --}}
          @foreach ($apartments as $apartment)
            <div class="card mb-3">
            <img class="card-img-top" src="{{ !empty($apartment->immagine) ? (substr($apartment->immagine,0,4)=='http') ?($apartment->immagine) : (asset('storage/'.$apartment->immagine)) : 'placeholders/placeholder-apartment.jpg'}}" alt="Card image cap">
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
              <p class="card-text"><small class="text-muted"></small>Ultimo aggiornamento: {{ $apartment->updated_at->format('d-M-Y - h:m') }}</p>

            </div>
          </div>

          @endforeach
          <p class="card-text">{{ $apartment->descrizione }}</p>
          {{-- da cambiare - es. stellina sponsorizzato --}}
          <p class="card-text"><small class="text-muted"></small>Sponsorizzato: {{ $apartment->sponsorizzato }}
          </p>
          <p class="card-text"><small class="text-muted">Ultimo aggiornamento:
              {{ $apartment->updated_at->format('d-M-Y - h:m') }}</small></p>

        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection