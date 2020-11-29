@extends('layouts.app')
@section('content')


<div class="container">
  @if (session('success_message'))
  <div class="alert alert-success">
    {{ session('success_message')}}
  </div>
  @endif
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <h3 class="text-primary mt-4 mb-3">{{$apartment->titolo}}</h3>
  <h5><i class="fas fa-map-marker-alt text-primary"></i> {{$apartment->indirizzo}}</h5>
  {{-- inizio carousel immagini --}}
  <div id="carouselExampleIndicators" class="carousel slide mt-3 mb-3 carousel-show" data-ride="carousel">
    @if ($images->count() == 0)
    {{-- carousel con solo un elemento per il placeholder, nel caso in cui l'appartamento non abbia alcuna immagine --}}
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active bg-primary"></li>

    </ol>
    <div class="carousel-inner col-md-8 offset-md-2">
      <div class="carousel-item active">
        <img src="{{asset('placeholders/placeholder-apartment.jpg')}}" class="d-block w-100" alt="placeholder">
      </div>
    </div>
    @else
    {{-- carousel se ci sono immagini caricate --}}
    <ol class="carousel-indicators">
      @foreach ($images as $key => $img)
      {{-- primo foreach per creare gli indicatori al fondo del carousel, uno per ogni immagine --}}
      <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"
        class="{{($key == 0)?'active':''}} bg-primary"></li>
      {{-- operatore ternario, se è la prima immagine imposto classe active--}}
      @endforeach
    </ol>
    <div class="carousel-inner col-md-8 offset-md-2">
      @foreach ($images as $key => $img)
      {{-- secondo foreach per caricare tutte le sigole immagini--}}
      <div class="carousel-item {{($key == 0)?'active':''}}">
        {{-- operatore ternario, se è la prima immagine imposto classe active--}}
        <img src="{{(substr($img->immagine,0,4)=='http') ?($img->immagine) : (asset('storage/'.$img->immagine))}}"
          class="d-block w-100" alt="...">
      </div>
      @endforeach
    </div>
    @endif
    <a class="carousel-control-prev text-primary" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next text-primary" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  {{-- finecarousel immagini --}}

  <div class="dati-appartamento mb-4 d-flex flex-column flex-md-row justify-content-md-between">
    <div id="descrizione" class="dati-app-box pr-3 mt-3 d-flex flex-column">
      <h5>Descrizione</h5>
      <p>{{$apartment->descrizione}}</p>
    </div>
    <div id="caratteristiche" class="dati-app-box mt-3 d-flex flex-column">
      <h5>Caratteristiche</h5>
      <span class="">Stanze: {{$apartment->numero_stanze}}</span>
      <span class="">Letti: {{$apartment->numero_letti}}</span>
      <span class="">Bagni: {{$apartment->numero_bagni}}</span>
      <span class="">Metri Quadrati: {{$apartment->mq}}</span>
    </div>
    <div id="optionals" class="dati-app-box mt-3 d-flex flex-column">
      <h5>Optionals</h5>
      @foreach ($apartment->optionals as $optional)
      <span><i class="fas fa-check text-success"></i> {{$optional->nome}}</span>

      @endforeach

      {{-- foreach per stampare tutti gli optional e checked quelli che ha l'appartamento
      @foreach ($optionals as $optional)
      <label for="optional">{{$optional->nome}}</label>
      <input type="checkbox" name="optionals[]" value="{{$optional->id}}"
        {{($apartment->optionals->contains($optional->id) ? 'checked' : '')}} disabled>
      @endforeach --}}
    </div>




  </div>
  @if ($proprietario)
  {{-- Sezione per proprietario appartamento --}}
  <div class="d-flex justify-content-around col-4 offset-4">
    <a class="btn btn-primary" href="{{ route('apartments.edit', $apartment->id )}}">Edit</a>
    <form action="{{ route('apartments.destroy', $apartment->id )}}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" name="button" class="btn btn-danger btn-delete-alert">Delete</button>
    </form>
  </div>


  {{-- aggiungere sponsorizzazione --}}
  <h2 for="sponsor" class="text-center text-primary mt-5">Sponsorizza</h2>

  @if ($sponsorizzato == null)
  <div class="text-center bg-danger">
    Non hai sponsorizzazioni attive su questo appartamento!
  </div>
  @else
  <div class="text-center bg-warning">
    L'appertamento è sponsorizzato fino al {{$sponsorizzato->format('d-M-Y - H:m')}}
  </div>
  @endif

  {{-- prova per sponsor --}}
  <div class="card-deck justify-content-around text-center">
    @foreach ($sponsors as $sponsor)
    <form action="{{route('payment.index')}}" method="post" enctype="multipart/form-data" class="card col-lg-4 mt-4 mb-5 border border-primary text-primary pt-3 pb-3">
      {{-- <div class="card"> --}}
        <h2 class="card-title">{{$sponsor->nome}}</h2>
        <h2 class="card-title">€ {{$sponsor->costo}}</h2>
        <hr>
        <h5 class="card-title">Sponsorizza il tuo appartamento per {{$sponsor->durata}} ore!</h5>
        <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
        <input type="hidden" name="costo" value="{{$sponsor->costo}}">
        <input type="hidden" name="sponsor_id" value="{{$sponsor->id}}">
        @csrf
        @method('GET')
        <input type="submit" class="btn btn-success" value="Acquista">
      {{-- </div> --}}
    </form>
    @endforeach
    {{-- </form> --}}
  </div>


  {{-- inizio statistiche --}}
  <div id="stats" class="text-center text-primary mb-5" data-apartment-id="{{$apartment->id}}">
    <h2>Le tue statistiche</h2>
    <div class="mt-3">
      <h5>Visualizzazioni:</h5>
      <canvas class="col-12 offset-md-2 col-md-10 mx-auto" id="myVisitChart" {{-- width="400" height="400" --}}></canvas>
    </div>
    <div class="mt-3">
      <h5>Messaggi ricevuti:</h5>
      <canvas class="col-12 offset-md-2 col-md-10 mx-auto" id="myMessagesChart" {{-- width="400" height="400" --}}></canvas>
    </div>
  </div>
  {{-- fine statistiche --}}


  @else
  {{-- Sezione per utente non proprietario --}}

  <div class="row">

    {{-- inizio mappa --}}
    <div id="app" class="col-md-6 mb-4">
      <map-show v-bind:lat="{{$apartment->lat}}" v-bind:lng="{{$apartment->lng}}">
      </map-show>
    </div>

    {{-- inizio sezione se loggato ma no proprietario --}}
    @if (isset($user))
    @foreach ($user as $value)
    <div class="messaggi pl-3 pr-3 col-md-6">
      <h3 class="text-center">Contatta il proprietario</h3>
      {{-- stampa lista di eventuali messaggi precedenti --}}
      @if ($messages->count() > 0)
      <ul class="pb-2 d-flex flex-column align-items-end">
        @foreach ($messages as $message)
        <li class="d-flex flex-column messaggio-inviato mb-1"><span>{{$message->messaggio}} </span> <small
            class="text-muted">{{$message->created_at}}</small></li>
        @endforeach
      </ul>
      @endif
      {{-- inizia form per invio messaggio --}}
      <form action="{{route('messages.store')}}" method="post" enctype="multipart/form-data" class="">
        @csrf
        @method('POST')
        <div class="row">
          <div class="col-4 d-flex justify-content-end">
            @if (empty($value->avatar))
            <img class="avatar-messaggio" src="{{asset('placeholders/placeholder_avatar.svg')}}" alt="avatar">
            @else
            <img class="img-fluid rounded mx-auto avatar-messaggio"
              src="{{(substr($value->avatar,0,4)=='http') ?($value->avatar) : (asset('storage/'.$value->avatar))}}"
              alt="{{$value->nome. '-' . $value->cognome}}">
            @endif
          </div>
          <div class="col-8">
            {{-- <label class="form-control" for="nome">Nome:</label> --}}
            <input class="form-control mb-2" type="text" name="nome" value="{{$value->nome}}"
              placeholder="Inserisci il nome" disabled>
            {{-- <label class="form-control" for="email">E-mail:</label> --}}
            <input class="form-control mb-2" type="text" name="email" value="{{$value->email}}" disabled>
            <textarea class="form-control mb-2" name="messaggio" rows="4"
              placeholder="Inserisci il testo del messaggio"></textarea>
            <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
            <input type="submit" class="btn btn-primary col-12 col-md-6 offset-md-3" value="Invia">
          </div>
          {{-- <label class="form-control" for="messaggio">Messaggio:</label> --}}

        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
{{-- fine sezione se loggato ma no proprietario --}}
@else
{{-- inizio sezione se non loggato --}}
<div class="col-md-6 d-flex justify-content-center align-items-start">
  <a class="btn btn-lg btn-primary mb-3" href="{{ route('register')}}">
    <h4>Registrati per contattare il proprietario</h4>
  </a>
</div>
{{-- fine sezione se non loggato --}}
@endif
</div>
{{-- fine Sezione per utente non proprietario --}}
@endif


</div>
</div>
@endsection
