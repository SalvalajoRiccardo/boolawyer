@extends('layouts.app')
@section('content')
{{-- Messaggio di conferma dopo edit --}}
@if (session('updated'))
<div class="alert alert-success">
    
        {{session('updated')}}
    
</div>
@endif

<div class="container">
  <div class="row gutters-sm">

    {{-- LEFT COLUMN --}}
    <div class="col-md-4">

      <div class="card h-100">
       
        <div class="d-flex flex-column align-items-center text-center card-body">
          {{-- IMAGE --}}
          <div class="img_backend_box">
            @if ( $user->photo)
              <img src="{{ asset('storage/' . $user->photo)}}" class="img-fluid" alt="{{$user->name}}"  title="{{$user->name}}">
            @else
              <img src="{{asset('images/user.png')}}" alt="Admin" class="rounded-circle" width="150">
            @endif

          </div>
          
          
          <div class="mt-3">
            <h4>{{$user->name}} {{$user->surname}}</h4>

            {{-- Messages + reviews --}}
            <div class="my-3">
              {{-- Messages --}}
              <a href="{{route('admin.message_page')}}" type="button" class="btn btn-light position-relative m-2">
                <i class="bi bi-chat-dots-fill" style="font-size:1.1rem"></i>
                {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bronze_button">
                  {{count($user->messages)}}+
                </span> --}}
              </a>

              {{-- Review --}}
              <a href="{{route('admin.review_page')}}" type="button" class="btn btn-light position-relative m-2">
                <i class="bi bi-pencil" style="font-size:1.1rem"></i>
                {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bronze_button">
                  {{count($user->reviews)}}+
                </span> --}}
              </a>

              {{-- SPONSOR --}}
              <a href="{{route('admin.sponsor.index')}}" type="button" class="btn btn-light position-relative m-2">
                <i class="bi bi-star-fill" style="font-size:1.1rem"></i> 
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bronze_button">
                  BUY
                </span>
              </a>
            </div>

            <a href="{{route('admin.users.edit', $user->id )}}" class="btn grey_button_p d-block">Modifica info</a>
            <a href="{{route('change.password')}}" class="btn blue_button_p d-block my-3">Cambia password</a>
            <a href="#" class="btn btn-dark d-block">Cancella Profilo</a>
            
          </div>

        </div>
     
      </div>

    </div>

    {{-- RIGTH COLUMN --}}
    <div class="col-md-8">

      <div class="card h-100">
        {{-- start Card Body --}}
        <div class="card-body">

          {{-- Name --}}
          <div class="row align-items-center">
            <div class="col-sm-4">
              <h6 class="mb-2">Nome</h6>
            </div>
            <div class="col-sm-8 text-secondary">
              {{$user->name}}
            </div>
          </div>
          <hr>

          {{-- Surname --}}
          <div class="row align-items-center">
            <div class="col-sm-4">
              <h6 class="mb-2">Cognome</h6>
            </div>
            <div class="col-sm-8 text-secondary">
              {{$user->surname}}
            </div>
          </div>
          <hr>

          {{-- EMAIL --}}
          <div class="row align-items-center">
              <div class="col-sm-4">
                  <h6 class="mb-2">Email</h6>
              </div>
              <div class="col-sm-8 text-secondary">
                  {{$user->email}}
              </div>
          </div>
          <hr>

          {{-- Phone --}}
          <div class="row align-items-center">
            <div class="col-sm-4">
              <h6 class="mb-2">Telefono</h6>
            </div>
            <div class="col-sm-8 text-secondary">
              {{-- phone right part/ tasto per richiesta numero di telefono --}}
              @if ($user->phone)
              {{$user->phone}}
              @else
                <a class="btn blue_button_outline_p" href="{{route('admin.users.edit', $user->id )}}">
                  Inserisci il tuo telefono
                </a>
              @endif
              
            </div>
          </div>
          <hr>

          {{-- CV --}}
          <div class="row align-items-center">
            <div class="col-sm-4">
              <h6 class="mb-2">CV</h6>
            </div>
            <div class="col-sm-8 text-secondary">
            <!-- Button trigger modal -->
              
              @if ($user->cv)
              <button  type="button" class="btn blue_button_p" data-toggle="modal" data-target="#exampleModalLong">
                Visualizza CV
              </button>
              @else
                    <a class="btn bronze_button" href="{{route('admin.users.edit', $user->id )}}">
                      Inserisci il tuo CV
                    </a>
              @endif

              <!-- Modal -->
              <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">CV</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <img src="{{ asset('storage/' . $user->cv)}}" class="img-fluid" alt="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>

          {{-- Address --}}
          <div class="row align-items-center">
              <div class="col-sm-4">
                <h6 class="mb-2 mr-2">Indirizzo</h6>
              </div>
              <div class="col-sm-8 text-secondary">
                {{$user->address}}
              </div>
          </div>
          <hr>

          {{-- Specializations --}}
          <div class="row align-items-center">
            <div class="col-sm-4">
              <h6 class="mb-2 ">Specializzazioni</h6>
            </div>
            <div class="col-sm-8 text-secondary">
              @foreach ($user->specializations as $specialization)    
                <span class="btn blue_button_transparent mb-2">{{$specialization->name}}</span>
              @endforeach

              {{-- da aggiungere effetto a comparsa su hover --}}
              <a class="btn blue_button_outline_p mb-2" href="{{route('admin.users.edit', $user->id )}}">
                Aggiungi <i class="bi bi-plus-lg"></i>
              </a>    
            </div>
          </div>
          <hr>

          {{-- Services --}}
          <div class="row">
            <div class="col-sm-4">
              <h6 class="mb-2">Prestazioni</h6>
            </div>
            <div class="col-sm-8 text-secondary">
               {{-- services right part/ tasto per richiesta inserimento servizi --}}
               @if ($user->services)
                <p>{{$user->services}}</p>
               @else
                <a class="btn blue_button_outline_p" href="{{route('admin.users.edit', $user->id )}}">
                  Inserisci le tue Prestazioni
                </a>
               @endif
            </div>
          </div>

        </div>
        {{-- end Card Body --}}
      </div>

    </div>

</div>
</div>

  

         
</div>
    
@endsection
