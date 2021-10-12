@extends('layouts.app')

@section('content')



  <div class="container">
    <div class="row py-4">
        <div class="col">
          <input type="text" class="form-control" placeholder="Name" aria-label="First name" value="{{$user->name}}">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Surname" aria-label="Last name" value="{{$user->surname}}">
        </div>
    </div>

    <div class="row py-4">
        <div class="col">
            <input type="text" class="form-control" placeholder="Name" aria-label="First name" value="{{$sponsor->name}} ">
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Surname" aria-label="Last name" value="{{$sponsor->price}} euro">
        </div>
    </div>


   

</div>
@endsection