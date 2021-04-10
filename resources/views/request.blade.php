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

       @if ((Auth::user()->admin) == false)
       {{-- checks if the current user is  an common user --}}
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
                   <td><a href="{{route('delete-request',$wish->id)}}" class="btn btn-danger">Delete</a></td>
                   <td><a class="btn btn-success" role="button" data-toggle="modal" data-target="#wish-detail_{{$wish->id}}">View</a></td>
                </tr>

                <!-- Modal for wish details  -->
            <div class="modal fade" id="wish-detail_{{$wish->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                            {{-- if the wish is granted then show the granted user details --}}
                            @if ($wish->status ==='Granted')
                                <hr>
                                <h5 class="font-weight-bold my-1">Granted by: {{$wish->grant_name}}</h5>
                                <h5 class="font-weight-bold my-1">Email: {{$wish->grant_email}}</h5>
                                <h5 class="font-weight-bold my-1">Phone number: {{$wish->grant_phone_number}}</h5>
                            @endif
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if ($wish->status==='Pending')
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    @endif
                    </div>
                </form>
                </div>
                </div>
            </div>
                @endforeach
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
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" aria-label="name" placeholder="Enter your full name" >
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
