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
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @guest
    <a href="{{route('new-wish')}}" class="btn btn-success py-2"><i class="fa fa-plus"></i>&nbsp; @lang('Add a New Wish')</a>
    @endguest
    <div class="container my-4" id="wishes">
        <h2 class="text-center font-weight-bold pb-2">Wish List</h2>
       @foreach ($wishes->chunk(2) as $chunked_data)
       <div class="row hidden-md-up my-3">
          @foreach ($chunked_data as $wish)
          <div class="col-md-6">
            <div class="card rounded">
              <div class="card-block p-4">
                <h4 class="card-title">{{$wish->name}}</h4>
                <h6 class="card-subtitle text-muted pb-2">{{$wish->email}}</h6>
                <h6 class="card-subtitle text-muted pb-2">{{$wish->phone_number}}</h6>

                <p class="card-text p-y-2">{{$wish->description}}</p>

                @if ($wish->amount != null)
                <p class=" mt-1 mb-2" style="font-size:14px">@lang('Amount needed'): <span class="font-weight-bold">&nbsp;₹ {{$wish->amount}}</span></p>
                @endif
                <p class="my-2 text-muted" style="font-size: 12px"><i>@lang('Created') : {{$wish->created_at->diffForHumans()}}</i></p>
                @guest
                <a class="btn btn-primary block" role="button" data-toggle="modal" data-target="#wish-grant{{$wish->id}}">@lang('Fulfil Wish')</a>
                @endguest
            </div>
                     {{-- Modal for granting user wish --}}
      <div class="modal fade" id="wish-grant{{$wish->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('request-grant')}}" method="GET">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('Fulfil') {{$wish->name}} @lang('wish')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" value="{{$wish->id}}" name="id">
                    <div class="form-group mb-2">
                        <label for="name">@lang('Name')</label>
                        <input type="text" id="name" name="name" class="form-control" aria-label="name" placeholder="@lang('Enter your full name')" required >
                    </div>

                    <div class="form-group mb-2">
                        <label for="Email">@lang('Email')</label>
                        <input type="email" name="email" class="form-control" aria-label="email" placeholder="@lang('youremail@domain.com')" required >
                    </div>

                    <div class="form-group mb-2">
                        <label for="phone_no">@lang('Phone number')</label>
                        <input type="number" name="phone_no" class="form-control" aria-label="phone_no" placeholder="@lang('Enter your phone number')" required >
                    </div>
                    <div class="my-2">
                        <span class="text-muted" style="font-size: 11px;">@lang('The requestee will see this details when you grant this wish')</span>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
            <button class="btn btn-primary" type="submit">@lang('Grant')</button>
            </div>
        </form>
        </div>
        </div>
    </div>
            </div>
          </div>
          @endforeach
       </div>

       @endforeach

        <div class="ml-3">
            {{ $wishes->links() }}
        </div>

      </div>


</div>
@endsection
