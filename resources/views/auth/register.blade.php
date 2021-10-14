@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-4 register_login_image">
                {{-- <img src="{{asset('images/pexels-photo-8755742.jpeg')}}" class="img-fluid rounded-start" alt="..."> --}}
            </div>
            <div class="col-md-8 p-0 ">
                <div class="card-body text-center p-0">
                  
                    <div class="card-header background_transparent_bronze"><h4>{{ __('Register') }}</h4></div>
                
                    <form method="POST" action="{{ route('register') }}" class="py-5">
                        @csrf
                        
                    
                        {{-- NAME --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- SURNAME --}}
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
                            
                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                                
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- SPECIALIZATIONS --}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Specializations') }}</label>
                            
                            <div class="col-md-6">
                                <select name="specializations"  class="form-control">
                                    @foreach($data as $spec)
                                    <option value="{{$spec->id}}">{{$spec->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        {{-- ADDRESS --}}
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- EMAIL --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- PASSWORD --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- PASSWORD-CONFIRM --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn blue_button_p">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        
                    </form>
    
                        {{-- @if($errors->any()){
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        }
                        @endif --}}
    
                </div>
            </div>
        </div>
    </div>
    


</div>
@endsection
