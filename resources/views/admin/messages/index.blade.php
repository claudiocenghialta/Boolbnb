@extends('layouts.app')

@section('content')

<table class="table container">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Appartamento</th>
      <th scope="col">Messaggio</th>
      <th scope="col">Mail Mittente</th>
      <th scope="col">Ricevuto il</th>
      <th>Mail</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($apartments as $apartment)
    @foreach ($apartment->messages as $message)
    <tr>
      {{-- @dd($message); --}}
      <th scope="row">{{$apartment->titolo}}</th>
      <td>{{$message->messaggio}}</td>
      <td>{{$message->user->email}}</td>
      <td>{{$message->updated_at->format('D d/m/Y - H:m')}}</td>
      <td><a
          href="mailto:{{$message->user->email}}?subject=Informazioni - {{$apartment->titolo}}&body={{"---Messaggio Originale---".$message->messaggio}}">Rispondi
          via mail</a></td>
    </tr>
    @endforeach
    @endforeach


  </tbody>
</table>


@endsection
