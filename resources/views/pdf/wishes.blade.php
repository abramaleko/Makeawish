<style>

    table, td, th {
         padding: 15px;
         text-align: left;
         border-bottom: 1px solid #ddd;

        }

table {
  width: 100%;
  border-collapse: collapse;
}

</style>
<div class="container">
          <div class="my-3">
              <h3 class="font-weight-bold">Completed wishes: <span class="text-primary">&nbsp; {{$granted}} / {{count($wishes)}}</span></h3>
          </div>
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
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
    </div>
</div>


