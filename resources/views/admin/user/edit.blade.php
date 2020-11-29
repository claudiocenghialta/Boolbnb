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

<h1 class="text-center text-primary mt-3">Modifica il profilo</h1>
<div class="card mb-3 mx-auto col-5" >
  <div class="row no-gutters">
    <div class="col-md-4 pt-3">

      @if (empty($user->avatar))
      <img class="img-fluid rounded mx-auto card-img-top" src="{{asset('placeholders/placeholder_avatar.svg')}}" alt="avatar">
      @else
      <img class="img-fluid rounded mx-auto card-img-top"
        src="{{(substr($user->avatar,0,4)=='http') ?($user->avatar) : (asset('storage/'.$user->avatar))}}"
        alt="{{$user->nome. '-' . $user->cognome}}">
        {{-- NOPE --}}
      <form action="{{ route('images.destroy', $user->avatar )}}" method="post">
        @csrf
        @method('DELETE')
          <button type="submit" name="button" class="btn btn-alert btn-delete-alert text-danger">X</button>
      </form>
      @endif
        <h5 class="card-title text-center font-weight-bold ">{{$user->nome}}</h5>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Nome: {{$user->nome}}</li>
          <li class="list-group-item">Cognome: {{$user->cognome}}</li>
          <li class="list-group-item">Data di Nascita: {{$user->data_di_nascita}}</li>
          <li class="list-group-item">E-mail: {{$user->email}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>


{{-- @if (empty($user->avatar))
<img class="img-fluid rounded mx-auto" src="{{asset('placeholders/placeholder_avatar.svg')}}" alt="avatar">
@else
<img class="img-fluid rounded mx-auto"
  src="{{(substr($user->avatar,0,4)=='http') ?($user->avatar) : (asset('storage/'.$user->avatar))}}"
  alt="{{$user->nome. '-' . $user->cognome}}">
<form action="{{ route('images.destroy', $user->avatar )}}" method="post">
  @csrf
  @method('DELETE')
  <button type="submit" name="button" class="btn btn-alert btn-delete-alert">Delete</button>
</form>
@endif --}}

<form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data"
  class="card col-5 mx-auto mb-5">
  @csrf
  @method('PATCH')
  <label class="mt-2" for="avatar">Immagine avatar</label>
  <input type="file" name="avatar" accept="image/*">
  <label class="mt-2" for="nome">Nome:</label>
  <input type="text" name="nome" value="{{$user->nome}}" placeholder="Inserisci il nome">
  <label class="mt-2" for="cognome">Cognome:</label>
  <input type="text" name="cognome" value="{{$user->cognome}}" placeholder="Inserisci il cognome">
  <label class="mt-2" for="data_di_nascita">Data di Nascita:</label>
  <input type="date" name="data_di_nascita" value="{{$user->data_di_nascita}}"
    placeholder="Inserisci la data di nascita">
  <label class="mt-2" for="email">E-mail:</label>
  <input type="text" name="email" value="{{$user->email}}" disabled>
  <input type="submit" class="btn btn-primary mt-3 mb-3" value="Salva">
</form>
@endsection
