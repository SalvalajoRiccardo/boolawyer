@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row gutters-sm">

    {{-- LEFT COLUMN --}}
    <div class="col-md-4 mb-3">

      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            {{-- IMAGE --}}
            @if ( $user->photo)
            <img src="{{ asset('storage/' . $user->photo)}}" class="img-fluid" alt="">
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
            Here goes the Cv
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
