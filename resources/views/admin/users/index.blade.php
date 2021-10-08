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
    <div class="col-md-4 mb-3">

      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            {{-- IMAGE --}}
            @if ( $user->photo)
            <img src="{{ asset('storage/' . $user->photo)}}" class="img-fluid" alt="{{$user->name}}"  title="{{$user->name}}">
            @else
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
            @endif
           
           

            <div class="mt-3">
              <h4>{{$user->name}} {{$user->surname}}</h4>

              <a href="{{route('admin.users.edit', $user->id )}}" class="btn btn-secondary d-block">Edit Info</a>
              <a href="{{route('change.password')}}" class="btn btn-primary d-block my-3">Change password</a>
              <a href="#" class="btn btn-danger d-block">Delete Profile</a>
              
            </div>
          </div>
        </div>
      </div>

    </div>

    {{-- RIGTH COLUMN --}}
    <div class="col-md-8">

      <div class="card mb-3">
        {{-- start Card Body --}}
        <div class="card-body">

          {{-- Name --}}
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Name</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{$user->name}}
            </div>
          </div>
          <hr>

          {{-- Surname --}}
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Surname</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{$user->surname}}
            </div>
          </div>
          <hr>

          {{-- EMAIL --}}
          <div class="row">
              <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                  {{$user->email}}
              </div>
          </div>
          <hr>

          {{-- Phone --}}
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Phone</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{$user->phone}}
            </div>
          </div>
          <hr>

          {{-- CV --}}
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">CV</h6>
            </div>
            <div class="col-sm-9 text-secondary">
            <!-- Button trigger modal -->
              
              @if ($user->cv)
              <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                Visualizza CV
              </button>
              @else
                    <a class="btn btn-warning" href="{{route('admin.users.edit', $user->id )}}">
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
          <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{$user->address}}
              </div>
          </div>
          <hr>

          {{-- Specializations --}}
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Specializations</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              @foreach ($user->specializations as $specialization)    
                <span span class="text-secondary mb-1 badge bg-info text-dark">{{$specialization->name}}</span>
              @endforeach

              {{-- da aggiungere effetto a comparsa su hover --}}
              <a class="btn btn-warning" href="{{route('admin.users.edit', $user->id )}}">
                Aggiungi specializzazioni
              </a>    
            </div>
          </div>
          <hr>

          {{-- Services --}}
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Services</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <p>{{$user->services}}</p>
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
