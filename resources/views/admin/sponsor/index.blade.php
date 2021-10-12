@extends('layouts.app')
@section('content')
  <div class="container">

        {{-- ROW with Cards --}}
        <div class="row">
            @foreach ($data as $sponsor)
                
            <div class="col-4">
                <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{$sponsor->name}}</div>
                    <div class="card-body">
                    <h5 class="card-title">Prezzo: ${{$sponsor->price}}</h5>
                    <p class="card-text">durata: {{$sponsor->duration}}ore</p>
                    <a href="{{route('admin.sponsor.show', $sponsor->id)}}" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Go-Back Button -->
        <a class="btn btn-secondary" href="{{route('admin.users.index')}}">Go Back</a>
  </div>
@endsection