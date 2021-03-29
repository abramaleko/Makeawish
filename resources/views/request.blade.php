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
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <caption>List of all your wishes</caption>
            <thead>
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Amount (Rupees)</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Confirm Wish granted</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($wishes as $wish)
                <tr>
                    <td>{{$wish->description}}</td>
                    <td>{{$wish->amount}}</td>
                    <td>{{$wish->status}}</td>
                    <td>{{$wish->created_at->format('d M Y')}}</td>
                    <td><a href="" class="btn btn-success btn-sm px-3"><i class="fa fa-check"></i>&nbsp; Grant</a></td>
                  </tr>
                @endforeach
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
                    <form action="{{route('upload-request')}}" method="POST">
                        @csrf
                        <div class="form-group my-3">
                            <label for="description">Description of your wish</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Describe what do you need.."></textarea>
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><img src="{{asset('icons/rupee.svg')}}" class="inline" width="11"></span>
                            </div>
                            <input type="number" name="amount" class="form-control" aria-label="Amount" placeholder="Enter the amount needed for your need" >
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
</div>

@endsection
