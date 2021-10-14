@extends('layouts.app')
@section('content')
  <div class="container">

    @if (session()->has('success_message'))
    <div class="alert alert-success">
      {{ session()->get('success_message') }}
    </div>
    @endif

    {{-- ROW with Cards --}}
    <div class="row">
      @foreach ($data as $sponsor)
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card card1 h-100">
          <div class="card-body">
            
            <h5 class="card-title">{{$sponsor->name}}</h5>
            <h6 class='text-muted'>Sponsorizza il tuo profilo nella Homepage</h6>
            <br><br>
            <span class="h3">Prezzo: {{$sponsor->price}}	&euro;</span>
            <span class="h6 d-block my-3">Validità: {{$sponsor->duration}}	ore</span>
            <br><br>
            <div class="d-grid my-3">
              <a href="{{route('admin.sponsor.show', $sponsor->id)}}" class="btn btn-outline-dark btn-block">Acquista ora</a>
            </div>

          </div>

          
        </div>
      </div>
      @endforeach
    </div>

    <!-- Go-Back Button -->
    <a class="btn btn-secondary" href="{{route('admin.users.index')}}">Indietro</a>
  </div>
@endsection