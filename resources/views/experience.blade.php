@extends('layouts.app')
<style>
 @media only screen and (max-width: 600px) {
  #experiences {
    width: auto !important;
  }
}
</style>

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="my-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newExperience"><i class="fa fa-plus"></i>&nbsp;Add Feedback</button>
    </div>

    <div class="card m-auto " id="experiences" style="width:45rem; border-radius:1rem;">
        @foreach ($experiences as $experience)
                <div class="card-body">
                <h5 class="card-title">{{$experience->name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$experience->email}}</h6>
            <p class="card-text">{{$experience->description}}</p>
            <p class="my-2 text-muted" style="font-size: 12px"><i>Created : {{$experience->created_at->diffForHumans()}}</i></p>
             @auth
             <form action="{{route('experience.destroy',$experience->id)}}" method="POST">
                <button class="btn btn-danger">DELETE</button>
                @method('DELETE')
               @csrf
            </form>
             @endauth
            </div>
            <hr>
        @endforeach

        <div class="ml-3">
            {{ $experiences->links() }}
        </div>

        @include('modals.newExperience')

      </div>


</div>
@endsection
