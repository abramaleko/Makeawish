@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
    <div class="my-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newWish"><i class="fa fa-plus"></i>&nbsp;Request a New Wish</button>
    </div>
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
        <div class="my-3">
            <form class="form-inline" method="get" action="{{route('request')}}">
                 <label class="sr-only" for="reference_code">Reference number</label>
                 <div class="input-group mb-2 mr-sm-2">
                   <div class="input-group-prepend">
                     <div class="input-group-text"><i class="fa fa-search"></i></div>
                   </div>
                   <input type="number" name="reference_code" class="form-control" id="reference_code" placeholder="Enter your reference number">
                 </div>
                 <button type="submit" class="btn btn-outline-secondary mb-2">Search</button>
               </form>
        </div>
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <caption>Details of your request</caption>
            <thead>
              <tr>
                <th scope="col">Reference number</th>
                <th scope="col">Name</th>
                {{-- <th scope="col">Email</th>
                <th scope="col">Phone number</th> --}}
                {{-- <th scope="col">Description</th> --}}
                <th scope="col">Amount (₹)</th>
                {{-- <th scope="col">Status</th> --}}
                <th scope="col">Date</th>
                {{-- <th scope="col">Confirm Wish granted</th> --}}
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @isset($wish)
                <tr>
                    <td>{{$wish->reference_code}}</td>
                    <td>{{$wish->name}}</td>
                    {{-- <td>{{$wish->email}}</td> --}}
                    {{-- <td>{{$wish->phone_number}}</td> --}}
                    {{-- <td>{{$wish->description}}</td> --}}
                    <td>{{$wish->amount}}</td>
                    {{-- <td>{{$wish->status}}</td> --}}
                    <td>{{$wish->created_at->format('d M Y')}}</td>
                    {{-- <td><a href="{{route('request-grant',$wish->id)}}" class="btn btn-success btn-sm px-3 {{$wish->status=='Granted'? 'disabled' : ''}}"><i class="fa fa-check"></i>&nbsp; Grant</a></td> --}}
                   <td><a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#wish-detail">View</a></td>
                </tr>
                @endisset
            </tbody>
          </table>
    </div>

         <!-- Modal for new wish -->
        <div class="modal fade" id="newWish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request for a new wish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('upload-request')}}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="description">Name</label>
                            <input type="text" name="name" class="form-control" aria-label="name" placeholder="Enter your full name" >
                        </div>

                        <div class="form-group mb-2">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-control" aria-label="email" placeholder="youremail@domain.com" >
                        </div>

                        <div class="form-group mb-2">
                            <label for="phone_no">Phone number</label>
                            <input type="number" name="phone_no" class="form-control" aria-label="phone_no" placeholder="Enter your phone number" >
                        </div>

                        <div class="form-group mb-2">
                            <label for="description">Description of your wish</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Describe what do you need.."></textarea>
                          </div>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><img src="{{asset('icons/rupee.svg')}}" class="inline" width="11"></span>
                            </div>
                            <input type="number" name="amount" class="form-control" aria-label="Amount" placeholder="Enter the amount needed for your need" >
                          </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
            </div>
            </div>
        </div>

           @isset($wish)
<!-- Modal for wish details  -->
<div class="modal fade" id="wish-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{route('update-request')}}" method="POST">
                @csrf
                <input type="hidden" name="wish_id" value="{{$wish->id}}">
                <div class="form-group mb-2">
                    <label for="description">Name</label>
                    <input type="text" name="name" class="form-control" aria-label="name"  value="{{$wish->name}}">
                </div>

                <div class="form-group mb-2">
                    <label for="Email">Email</label>
                    <input type="email" name="email" class="form-control" aria-label="email" value="{{$wish->email}}" >
                </div>

                <div class="form-group mb-2">
                    <label for="phone_no">Phone number</label>
                    <input type="number" name="phone_no" class="form-control" aria-label="phone_no" value="{{$wish->phone_number}}">
                </div>

                <div class="form-group mb-2">
                    <label for="description">Description of your wish</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{$wish->description}}</textarea>
                  </div>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><img src="{{asset('icons/rupee.svg')}}" class="inline" width="11"></span>
                    </div>
                    <input type="number" name="amount" class="form-control" aria-label="Amount" value="{{$wish->amount}}" >
                  </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
    </form>
    </div>
    </div>
</div>
           @endisset
</div>

@endsection
