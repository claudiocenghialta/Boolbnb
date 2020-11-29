@extends('layouts.app')
@section('content')

{{-- @if (empty($user->avatar))
<img class="img-fluid rounded mx-auto" src="{{asset('placeholders/placeholder_avatar.svg')}}" alt="avatar">
@else
<img class="img-fluid rounded mx-auto"
  src="{{(substr($user->avatar,0,4)=='http') ?($user->avatar) : (asset('storage/'.$user->avatar))}}"
  alt="{{$user->nome. '-' . $user->cognome}}">
@endif

<p>Nome: {{$user->nome}}</p>
<p>Cognome: {{$user->cognome}}</p>
<p>Data di Nascita: {{$user->data_di_nascita}}</p>
<p>E-mail: {{$user->email}}</p>
<a href="{{ route('users.edit', $user->id )}}">Edit</a>
<form action="{{ route('users.destroy', $user->id )}}" method="post">
  @csrf
  @method('DELETE')
  <button type="submit" name="button" class="btn btn-danger btn-delete-alert">Delete</button>
</form> --}}

{{-- CARD VERTICALE --}}
{{-- <h1 class="text-center text-primary">Il tuo profilo</h1>
<div class="card mx-auto" style="width: 18rem;">
  @if (empty($user->avatar))
  <img class="img-fluid rounded mx-auto card-img-top" src="{{asset('placeholders/placeholder_avatar.svg')}}" alt="avatar">
  @else
  <img class="img-fluid rounded mx-auto card-img-top"
    src="{{(substr($user->avatar,0,4)=='http') ?($user->avatar) : (asset('storage/'.$user->avatar))}}"
    alt="{{$user->nome. '-' . $user->cognome}}">
  @endif
  <div class="card-body">
    <h5 class="card-title text-center font-weight-bold">{{$user->nome}}</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Nome: {{$user->nome}}</li>
    <li class="list-group-item">Cognome: {{$user->cognome}}</li>
    <li class="list-group-item">Data di Nascita: {{$user->data_di_nascita}}</li>
    <li class="list-group-item">E-mail: {{$user->email}}</li>
  </ul>
  <div class="card-body d-flex justify-content-around">
    <div class="">
      <a class="btn btn-primary" href="{{ route('users.edit', $user->id )}}">Edit</a>
    </div>
    <form action="{{ route('users.destroy', $user->id )}}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" name="button" class="btn btn-danger btn-delete-alert">Delete</button>
    </form>
  </div>
</div> --}}

{{-- CARD ORIZZONTALE --}}
<h1 class="text-center text-primary mt-3">Il tuo profilo</h1>
<div class="card mb-3 mx-auto col-6" >
  <div class="row no-gutters">
    <div class="col-md-4 pt-3">
      @if (empty($user->avatar))
        <div class="rounded-circle" style="max-height: 25px; max-width:25px">
          <img class="img-fluid rounded mx-auto card-img-top" src="{{asset('placeholders/placeholder_avatar.svg')}}" alt="avatar">
        </div>
      @else
        <div class="rounded-circle">
          <img class="img-fluid rounded mx-auto card-img-top"
            src="{{(substr($user->avatar,0,4)=='http') ?($user->avatar) : (asset('storage/'.$user->avatar))}}"
            alt="{{$user->nome. '-' . $user->cognome}}">
        </div>
      @endif
        <h5 class="card-title text-center font-weight-bold mt-2">{{$user->nome}}</h5>
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
<div class="d-flex justify-content-around mx-auto col-3">
  <div class="">
    <a class="btn btn-primary" href="{{ route('users.edit', $user->id )}}">Edit</a>
  </div>
  <form action="{{ route('users.destroy', $user->id )}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" name="button" class="btn btn-danger btn-delete-alert">Delete</button>
  </form>
</div>

@endsection
