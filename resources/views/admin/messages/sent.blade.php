@extends('layouts.app')

@section('content')

<table class="table container">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Appartamento</th>
      <th scope="col">Messaggio</th>
      <th scope="col">Mail Proprietario</th>
      <th scope="col">Inviato il</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($messages as $message)
    <tr>
      <th scope="row">{{$message->apartment->titolo}}</th>
      <td>{{$message->messaggio}}</td>
      <td>{{$message->apartment->user->email}}</td>
      <td>{{$message->updated_at->format('D d/m/Y - h:m')}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
