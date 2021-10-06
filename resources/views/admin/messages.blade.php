@extends('layouts.app')
@section('content')
    
    <div class="container">
        @foreach ($data->messages as $message)
            <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading"><i class="bi bi-person-badge"></i> {{$message->name}}</h4>
                <p>{{$message->text}}</p>
                <hr>
                <p class="mb-0">From: {{$message->email}}</p>
            </div>
        @endforeach
    </div>
    
@endsection