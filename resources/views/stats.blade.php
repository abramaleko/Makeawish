@extends('layouts.app')
@section('styles')
<style>
  .dropdown-search
  {
    border: 1px solid #374151 ;
    position: absolute;
    display: block;
    margin-top: 2.3rem;
    width:100%;
  }
  .dropdowns
  {
    display: block;
    padding: 3px 32px;
  }
  .dropdowns:hover
  {
     background-color: #D1D5DB;
     cursor: pointer;
  }
  #statsdetails
  {
      margin-top: 2.5rem;
  }
</style>
@endsection
@section('content')
<div class="container">

       <div class="my-3">
        <form class="form-inline">
             <label class="sr-only" for="requestee_name">Requestee name</label>
             <div class="input-group mb-2 mr-sm-2">
               <div class="input-group-prepend">
                 <div class="input-group-text"><i class="fa fa-user"></i></div>
               </div>
               <input class="form-control" type="text" id="requestee_name" name="requestee_name" onkeyup="searchname(this.value)"  placeholder="Enter your name">
                <div class="dropdown-search " id="dropdown-search">

                </div>
            </div>
        </form>
    </div>
          <div id="statsdetails">
              <h5 class="font-weight-bold">Completed wishes: <span class="text-primary" id="stats">&nbsp; </span></h5>
          </div>
    <div class="table-responsive-sm mt-5">
        <table class="table table-hover">
            <caption>Details of your request</caption>
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Amount (₹)</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>

              </tr>
            </thead>
            <tbody id="table-body">

            </tbody>
          </table>
    </div>


</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
 <script src="{{asset('js/moment.js')}}"></script>
  <script>
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    //when the page loads the dropdown box is hidden
    document.getElementById("dropdown-search").style.display="none";

    function searchname(name)
    {
        if (name.length ==0)
        {
            //hide the dropdown if the input is empty
            document.getElementById("dropdown-search").style.display="none";
        }
        if (name.length >= 3)
        {
            //search starts when the sting length is from 3
          $.ajax({
            type: 'POST',
            url:  '{{route('requestee-names')}}',
            data: {name:name},
            success: function(names)
            {
              names.forEach(name => {
                  document.getElementById("dropdown-search").innerHTML = "";
                    let span =document.createElement('span');
                    span.setAttribute('class','dropdowns');
                    span.setAttribute('onclick','getName(this.innerHTML)');
                    span.innerHTML=name.name;
                    document.getElementById("dropdown-search").style.display="block";
                    document.getElementById('dropdown-search').appendChild(span);
              });
            }
          });
        }
    }
    function getName(name)
    {
        //hides the dropdown search box
        document.getElementById("dropdown-search").style.display="none";

       $.ajax({
           type:'POST',
           url: '{{route('request-info')}}',
           data: {name: name},
           success: function(info)
           {
               let data=JSON.parse(info);
               data[0]['info'].forEach(info => {
                let row= document.createElement('tr');
                let col1= document.createElement('td');
                col1.innerHTML=info.name;
                let col2= document.createElement('td');
                col2.innerHTML=info.amount;
                let col3= document.createElement('td');
                col3.innerHTML=info.status;
                let col4= document.createElement('td');
                col4.innerHTML=moment(info.created_at).format("MMMM Do YYYY");
                row.appendChild(col1);
                row.appendChild(col2);
                row.appendChild(col3);
                row.appendChild(col4);
                document.getElementById("table-body").appendChild(row);
               });
               document.getElementById('stats').innerHTML= data[0] ['granted'] + "/" + data[0]['info'].length;
           }
       });
    }
  </script>
@endsection
