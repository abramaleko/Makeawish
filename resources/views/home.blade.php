@extends('layouts.app')
<style>
 @media only screen and (max-width: 600px) {
  #wishes {
    width: auto !important;
  }
}
</style>

@section('content')
<div class="container">
    <div class="card m-auto " id="wishes" style="width:45rem; border-radius:1rem;">
        @foreach ($wishes as $wish)
                <div class="card-body">
                <h5 class="card-title">{{$wish->user->name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$wish->user->email}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">{{$wish->user->phone_number}}</h6>
            <p class="card-text">{{$wish->description}}</p>
            <p class="font-weight-bold mt-1 mb-2" style="font-size:16px">Amount needed: ${{$wish->amount}}.</p>
            <span class=" text-muted" style="font-size: 12px"><i>Created : {{$wish->created_at->diffForHumans()}}</i></span>
            {{-- <a href="#" class="card-link">Card link</a> --}}
            </div>
            <hr>
        @endforeach

        <div class="ml-3">
            {{ $wishes->links() }}
        </div>

      </div>
</div>
@endsection
