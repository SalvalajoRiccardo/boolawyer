@extends('layouts.app')
@section('content')

<div class="row">


  <div class="col-xl-8 order-xl-1">
    <div class="card bg-light shadow">

      {{-- header --}}
      <div class="card-header bg-white border-0">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">My account</h3>
          </div>
          <div class="col-4 text-right">
            <a href="#!" class="btn btn-sm btn-primary">Settings</a>
          </div>
        </div>
      </div>


      {{-- body --}}
      <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <h6 class="heading-small text-muted mb-4">User information</h6>
          <div class="pl-lg-4">
            <div class="row">
               <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-username">Username</label>
                  <input name="slug" type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="{{$user->slug}} ">
                </div>
            </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{$user->email}}" @error('email') is-invalid @enderror>
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-first-name">First name</label>
                  <input name="name" type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="{{$user->name}}" @error('name') is-invalid @enderror>
                  @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-last-name">Last name</label>
                  <input name="surname" type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="{{$user->surname}}" @error('surname') is-invalid @enderror>
                  @error('surname')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">

          <!-- Address -->
          <h6 class="heading-small text-muted mb-4">Contact information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-address">Address</label>
                  <input name="address" id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="{{$user->address}}" type="text" @error('address') is-invalid @enderror>
                  @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-phone">Phone</label>
                  <input name="phone" id="input-phone" class="form-control form-control-alternative" placeholder="Insert Phone" value="{{$user->phone}}" type="text" @error('phone') is-invalid @enderror>
                  @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group focused">
                  
                  <label class="form-control-label" for="input-photo">Photo</label>

                  <input  name="photo" id="input-photo" class="form-control form-control-alternative" value="{{$user->photo}}" type="file" @error('photo') is-invalid @enderror>
                  @error('photo')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="mb-3">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo)}} " alt="">
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-phone">CV</label>
                  <input name="cv" id="input-cv" class="form-control form-control-alternative" placeholder="Insert cv" value="{{$user->cv}}" type="file" @error('cv') is-invalid @enderror>
                  @error('cv')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <img src="{{ asset('storage/' . $user->cv) }}" alt="" />
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">
          <!-- Description -->
          <h6 class="heading-small text-muted mb-4">About me</h6>
          <div class="pl-lg-4">
            <div class="form-group focused">
              <label>Services</label>
              <textarea name="services" rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">{{$user->services}}</textarea>
            </div>
          </div>
          <div class="mb-3">
            <label for="spec" class="form-label">Specialization</label>
            @foreach ($specs as $spec)
            <div class="form-check form-check-inline"  @error('specializations') is-invalid @enderror>
                <input class="form-check-input" type="checkbox" id="spec{{$spec->id}}" value="{{$spec->id}}"
                
                @if( !$errors->any() && $user->specializations->contains( $spec->id ) )
                    checked
                @elseif(in_array($spec->id, old('specializations',[])))
                    checked
                @endif
                name="specializations[]">
                <label class="form-check-label" for="spec{{$spec->id}}">{{$spec->name}}</label>
            </div>  
            
            @endforeach
            @error('specializations')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                      
        </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>

    </div>
  </div>
      

         
</div>
    
@endsection
