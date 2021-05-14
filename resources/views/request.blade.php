@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
      @if ((Auth::user()->admin) == false)
        <div class="my-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newWish"><i class="fa fa-plus"></i>&nbsp;Request a New Wish</button>
        </div>
      @endif
     {{-- displays all errors --}}
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
        @endforeach
          </ul>
         </div>
         @endif

       @if ((Auth::user()->admin) == false)
       {{-- checks if the current user is  common user --}}
       <div class="my-3">
        <form class="form-inline">
             <label class="sr-only" for="reference_code">Reference number</label>
             <div class="input-group mb-2 mr-sm-2">
               <div class="input-group-prepend">
                 <div class="input-group-text"><i class="fa fa-search"></i></div>
               </div>
               <input type="number" class="form-control" id="code" placeholder="Enter your reference number">
             </div>
             <button type="button" class="btn btn-outline-secondary mb-2" id="reference_code">Search</button>
        </form>
    </div>
       @endif
       @if ((Auth::user()->admin) == true)
          <div class="my-3">
              <h5 class="font-weight-bold">Completed wishes: <span class="text-primary">&nbsp; {{$granted}} / {{count($wishes)}}</span></h5>
          </div>
          <div class="my-3">
              <a href="{{route('request-pdf')}}" target="_blank" class="btn btn-dark px-3"><i class="fa fa-print px-2"></i>&nbsp;PRINT</a>
          </div>
       @endif
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <caption>Details of your request</caption>
            <thead>
              <tr>
                <th scope="col">Reference number</th>
                <th scope="col">Name</th>
                <th scope="col">Amount (₹)</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                @if ((Auth::user()->admin) == true)
                <th scope="col"></th>
                <th scope="col"></th>
                @endif
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @isset($wishes)
                @foreach ($wishes as $wish)
                <tr>
                    <td>{{$wish->reference_code}}</td>
                    <td>{{$wish->name}}</td>
                    <td>{{$wish->amount}}</td>
                    <td>{{$wish->status}}</td>
                    <td>{{$wish->created_at->format('d M Y')}}</td>
                    @if ((Auth::user()->admin) == true)
                    <td><a href="{{route('approve-request',$wish->id)}}" class="btn btn-primary rounded {{$wish->status != 'Pending approval' ? 'disabled' : ''}}">Approve</a></td>

                    <td><a role="button" data-toggle="modal" data-target="#decline-modal_{{$wish->id}}" class="btn btn-warning rounded text-dark {{($wish->status != 'Declined' || $wish->status != 'Pending approval')  ? 'disabled' : ''}}">Decline</a></td>
                    @endif
                   <td><a class="btn btn-success rounded" role="button" data-toggle="modal" data-target="#wish-detail_{{$wish->id}}">Details</a></td>
                   <td><a href="{{route('delete-request',$wish->id)}}" class="btn btn-danger rounded">Delete</a></td>
                </tr>
                @include('modals.wishDetails')
                @include('modals.decline')
                @endforeach
                @endisset
            </tbody>
          </table>
    </div>
         @include('modals.newWish')
</div>
@endsection

@section('scripts')
  <script>
      document.getElementById('reference_code').addEventListener('click',function(event)
      {
        let ref=document.getElementById('code').value;
        if (ref== '') {
           event.preventDefault();
        }
        else
        {
            // redirect to the reqest page
             window.location.href = "/request/"+ref;
        }
      });
  </script>
@endsection
