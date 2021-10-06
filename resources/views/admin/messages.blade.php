@extends('layouts.app')
@section('content')
    
    @foreach ($data->messages as $message)
    {{$message->name}}
    {{$message->email}}
    {{$message->text}}
    
        
    @endforeach
@endsection