  @extends('layouts.app')
        @section('content')
        <div class="container">
          <div class="mt-3">
            <h5 class="font-weight-bold">Completed wishes: <span class="text-primary">&nbsp; {{$granted}} / {{count($wishes)}}</span></h5>
        </div>
        <div class="my-3">
            <a href="{{route('request-pdf')}}" target="_blank" class="btn btn-dark px-3"><i class="fa fa-print px-2"></i>&nbsp;PRINT</a>
            <a href="{{route('request-excel')}}" target="_blank" class="btn btn-success px-3 ml-3">&nbsp;EXCEL FILE</a>
        </div>
        <div class="">
            <form class="form-inline" method="GET" action="{{route('filter-wishes')}}">
                <label for="filter">Filter Wishes:</label>
                <select name="filter" id="filter" class="form-control mx-3">
                   <option selected value="1">All</option>
                   <option value="2">Highest Price</option>
                   <option value="3">Lowest Price</option>
                   <option value="4">Granted Wishes</option>
                   <option value="5">Pending Wishes</option>
                   <option value="6">Recent Wishes</option>
                </select>
                <button type="submit" class="btn btn-primary mb-2 px-4">Filter</button>
              </form>
        </div>
    <div class="table-responsive-sm mt-5">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Amount (₹)</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>

              </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($wishes as $wish)
                 <tr>
                     <td>{{$wish->name}}</td>
                     <td>{{$wish->amount}}</td>
                     <td>{{$wish->status}}</td>
                     <td>{{$wish->created_at->format('M d Y')}}</td>
                 </tr>
                @endforeach
            </tbody>
          </table>
    </div>


</div>
@endsection
