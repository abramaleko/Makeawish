<style>
    table, td, th {
      border: 1px solid black;
      font-size: 12px;
    }
    td{

        padding:3px;
    }

    table {
      border-collapse: collapse;
      width: 80%;
    }
    </style>
    <div class="container">
              <div class="my-3">
                  <h3 class="font-weight-bold">Completed wishes: <span class="text-primary">&nbsp; {{$granted}} / {{count($wishes)}}</span></h3>
              </div>
        <div>
            <table>
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Granted By</th>
                    <th scope="col">Grantee Email</th>
                    <th scope="col">Grantee Phone #</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($wishes as $wish)
                    <tr>
                        <td>{{$wish->name}}</td>
                        <td>{{$wish->email}}</td>
                        <td>{{number_format($wish->amount)}}</td>
                        <td>{{$wish->grant_name ?? ' -'}}</td>
                        <td>{{$wish->grant_email ?? ' -'}}</td>
                        <td>{{$wish->grant_phone_number ?? ' -'}}</td>
                        <td>{{$wish->created_at->format('d/m/Y')}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>


