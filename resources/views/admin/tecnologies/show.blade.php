@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Dettaglio progetto</h1>
        <h3>{{$tecnology->name}}</h3>
        <p>{{$tecnology->created_at}}</p>
    </div>
@endsection
