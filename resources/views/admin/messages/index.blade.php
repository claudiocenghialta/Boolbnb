@extends('layouts.app')

@section('content')

<table class="table container mt-3 col-8">
  <thead class="thead-light bg-primary text-light">
    <tr>
      <th scope="col">Appartamento</th>
      <th scope="col">Messaggio</th>
      <th scope="col">E-mail mittente</th>
      <th scope="col">Ricevuto il</th>
      <th>E-mail</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($apartments as $apartment)
      @foreach ($apartment->messages as $message)
      <tr>
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
