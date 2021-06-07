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

       <div class="my-5">
        <form class="form-inline" autocomplete="off">
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
                    <td><a class="btn btn-success rounded" role="button" data-toggle="modal" data-target="#wish-detail_{{$wish->id}}">Details</a></td>
                    <td><a href="{{route('delete-request',$wish->id)}}" class="btn btn-danger rounded">Delete</a></td>
                </tr>
                @include('modals.wishDetails')
                @endforeach
                @endisset
            </tbody>
          </table>
    </div>
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
