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
     background-color: #276bd1;
     color: #ffffff;
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
        <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-wish-request-tab" data-toggle="pill" href="#pills-wish-request" role="tab" aria-controls="pills-wish-request" aria-selected="true">@lang('Wish Request')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-mystatus-tab" data-toggle="pill" href="#pills-mystatus" role="tab" aria-controls="pills-mystatus" aria-selected="false">@lang('My Status')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-allstatus-tab" data-toggle="pill" href="#pills-allstatus" role="tab" aria-controls="pills-allstatus" aria-selected="false">@lang('All Status')</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-wish-request" role="tabpanel" aria-labelledby="pills-wish-request-tab">
                @include('status.requests')
            </div>
            <div class="tab-pane fade" id="pills-mystatus" role="tabpanel" aria-labelledby="pills-mystatus-tab">
                @include('status.mystats')
            </div>
            <div class="tab-pane fade" id="pills-allstatus" role="tabpanel" aria-labelledby="pills-allstatus-tab">
                @include('status.allstatus')
            </div>
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
