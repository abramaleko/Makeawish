@extends('layouts.app')
@section('styles')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
   <div class="container">
       <a href="{{route('approve-all')}}" class="btn btn-primary btn-lg mb-4">APPROVE ALL PENDING WISHES</a>
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

    <div class="table-responsive-sm" style="margin-top: 1rem; width:100%">
        <div id="example_wrapper">

        </div>
        <table class="table table-hover" id="requests">
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
                    <td>
                        @lang($wish->status)
                        @if ($wish->status ==='Granted')
                        <span class="py-1 d-block text-muted">Granted By : {{$wish->grant_name}}</span>

                        @endif
                    </td>
                    <td>{{$wish->created_at->format('d/m/Y')}}</td>
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
@section('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script>
    $(document).ready(function() {
    var table = $('#requests').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>

@endsection
