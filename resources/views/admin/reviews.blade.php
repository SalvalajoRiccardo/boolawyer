@extends('layouts.app')
@section('content')
    

    <div class="container">

        @forelse ($data as $review)
            <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading"><i class="bi bi-person-badge"></i> {{$review->reviewer}}</h4>
                <p>{{$review->text}}</p>
                <hr>
                <p class="mb-0">Vote: {{$review->vote}}</p>
            </div>
        @empty
        <div class="alert alert-secondary" role="alert">
          
            <p>Non ci sono reviews</p>
           
        </div>
            
        @endforelse

        
        {{-- Pagination --}}
        {{ $data->links() }}
        
        <!-- Go-Back Button -->
        <a class="btn btn-secondary" href="{{route('admin.users.index')}}">Go Back</a>
    </div>
    
   
    
    
@endsection