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


@if (empty($user->avatar))
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
@endif

<form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data"
  class="card col-5 mx-auto">
  @csrf
  @method('PATCH')
  <label for="avatar">Immagine avatar</label>
  <input type="file" name="avatar" accept="image/*">
  <label for="nome">Nome:</label>
  <input type="text" name="nome" value="{{$user->nome}}" placeholder="Inserisci il nome">
  <label for="cognome">Cognome:</label>
  <input type="text" name="cognome" value="{{$user->cognome}}" placeholder="Inserisci il cognome">
  <label for="data_di_nascita">Data di Nascita:</label>
  <input type="date" name="data_di_nascita" value="{{$user->data_di_nascita}}"
    placeholder="Inserisci la data di nascita">
  <label for="email">E-mail:</label>
  <input type="text" name="email" value="{{$user->email}}" disabled>
  <input type="submit" class="btn btn-primary" value="Salva">
</form>
@endsection