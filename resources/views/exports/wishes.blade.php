<table class="table table-hover">
    <thead>
        <tr>
            <th>Completed Wishes:</th>
            <th>{{$granted}} / {{count($wishes)}}</th>
        </tr>
        <br><br>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Amount</th>
        <th scope="col">Status</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($wishes as $wish)
        <tr>
            <td>{{$wish->name}}</td>
            <td>{{$wish->email}}</td>
            <td>{{$wish->amount}}</td>
            <td>{{$wish->status}}</td>
            <td>{{$wish->created_at->format('d M Y')}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
