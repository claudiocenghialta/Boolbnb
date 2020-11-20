@extends('layouts.app')
@section('content')

@if (empty($user->avatar))
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
  <button type="submit" name="button" class="btn btn-danger">Delete</button>
</form>
@endsection