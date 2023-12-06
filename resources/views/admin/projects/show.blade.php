@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Dettaglio progetto</h1>
        <div class="d-flex justify-content-between align-items-center w-100">
            <h3>{{$project->name}}</h3>
            <div>
                @if ($project->tecnologies->count())
                    @foreach ($project->tecnologies as $tecnology)
                        <span class="badge bg-dark text-white">{{ $tecnology->name}}</span>
                    @endforeach
                @endif
            </div>
        </div>
        @if ($project->type)
         <p>Tipo lavoro: <strong> {{ $project->type->name}}</strong> </p>
        @endif
        <p>{{$project->description}}</p>
        <p>Url: {{$project->web_site}}</p>
        <p>Creazione: {{$project->date_creation}}</p>
    </div>
@endsection
