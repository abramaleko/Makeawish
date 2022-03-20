@extends('layouts.app')
@section('content')
   <div class="container">
    <div class="mt-5">
        <h5 class="font-weight-bold">@lang('Completed wishes'): <span class="text-primary">&nbsp; {{$granted}} / {{count($all_wishes)}}</span></h5>
    </div>
    <div class="my-3">
        <a href="{{route('request-pdf',Request::get('filter'))}}" target="_blank" class="btn btn-dark px-3"><i class="fa fa-print px-2"></i>&nbsp;@lang('PRINT')</a>
        <a href="{{route('request-excel')}}" target="_blank" class="btn btn-success px-3 ml-3">&nbsp;@lang('EXCEL FILE')</a>
    </div>
    <div class="">
        <form class="form-inline" method="GET" action="{{route('filter-wishes')}}">
            <label for="filter">@lang('Filter Wishes'):</label>
            <select name="filter" id="filter" class="form-control mx-3" required>
                <option selected disabled >@lang('Choose')..</option>
               <option value="1" {{Request::get('filter') == 1 ? 'selected' : ''}}>@lang('All')</option>
               <option value="2" {{Request::get('filter') == 2 ? 'selected' : ''}}>@lang('Highest Price')</option>
               <option value="3" {{Request::get('filter') == 3 ? 'selected' : ''}}>@lang('Lowest Price')</option>
               <option value="4" {{Request::get('filter') == 4 ? 'selected' : ''}}>@lang('Lowest Price')</option>
               <option value="5" {{Request::get('filter') == 5 ? 'selected' : ''}}>@lang('Pending Wishes')</option>
               <option value="6" {{Request::get('filter') == 6 ? 'selected' : ''}}>@lang('Recent Wishes')</option>
               <option value="7" {{Request::get('filter') == 7 ? 'selected' : ''}}>@lang('Granted Wishes')</option>
            </select>
            <button type="submit" class="btn btn-outline-primary mb-2 px-4">@lang('Filter')</button>
          </form>
    </div>
    <div class="table-responsive-sm mt-5">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Amount') (₹)</th>
                <th scope="col">@lang('Status')</th>
                <th scope="col">@lang('Date')</th>

              </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($all_wishes as $wish)
                 <tr>
                     <td>{{$wish->name}}</td>
                     <td>{{$wish->amount}}</td>
                     <td>@lang($wish->status)</td>
                     <td>{{$wish->created_at->format('M d Y')}}</td>
                 </tr>
                @endforeach
            </tbody>
          </table>
    </div>

   </div>
@endsection
