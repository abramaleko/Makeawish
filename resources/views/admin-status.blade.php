@extends('layouts.app')

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
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <caption>@lang('Details of your request')</caption>
            <thead>
              <tr>
                <th scope="col">@lang('Reference number')</th>
                <th scope="col">@lang('Reference number')</th>
                <th scope="col">@lang('Amount') (₹)</th>
                <th scope="col">@lang('Status')</th>
                <th scope="col">@lang('Date')</th>
                <th scope="col"></th>
                <th scope="col"></th>
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
                    <td><a href="{{route('approve-request',$wish->id)}}" class="btn btn-primary rounded {{$wish->status != 'Pending approval' ? 'disabled' : ''}}">@lang('Approve')</a></td>
                    <td><a role="button" data-toggle="modal" data-target="#decline-modal_{{$wish->id}}" class="btn btn-warning rounded text-dark {{$wish->status != 'Pending approval' ? 'disabled' : ''}}">@lang('Decline')</a></td>
                   <td><a class="btn btn-success rounded" role="button" data-toggle="modal" data-target="#wish-detail_{{$wish->id}}">@lang('Details')</a></td>
                   <td><a href="{{route('delete-request',$wish->id)}}" class="btn btn-danger rounded">@lang('Delete')</a></td>
                </tr>
                @include('modals.wishDetails')
                @include('modals.decline')
                @endforeach
                @endisset
            </tbody>
          </table>
    </div>

   </div>
@endsection
