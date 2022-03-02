<table class="table table-hover">
    <thead>
        <tr>
            <th>Completed Wishes:</th>
            <th>{{$granted}} / {{count($wishes)}}</th>
        </tr>
        <br><br>
      <tr>
        <th scope="col">S/N</th>
        <th scope="col">Requestee Name</th>
        <th scope="col">Requestee Email</th>
        <th scope="col">Requestee Wish</th>
        <th scope="col">Amount</th>
        <th scope="col">Status</th>
        <th scope="col">Granted By</th>
        <th scope="col">Grantee Email</th>
        <th scope="col">Grantee Phone #</th>


        <th scope="col">Requested Date</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($wishes as $wish)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$wish->name}}</td>
            <td>{{$wish->email}}</td>
            <td>{{$wish->description}}</td>
            <td>{{$wish->amount}}</td>
            <td>{{$wish->status}}</td>
            <td>{{$wish->grant_name}}</td>
            <td>{{$wish->grant_email}}</td>
            <td>{{$wish->grant_phone_number}}</td>
            <td>{{$wish->created_at->format('d M Y')}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
