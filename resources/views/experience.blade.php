@extends('layouts.app')
<style>
 @media only screen and (max-width: 600px) {
  #experiences {
    width: auto !important;
  }
}
</style>

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="my-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newExperience"><i class="fa fa-plus"></i>&nbsp;@lang('Add Feedback')</button>
    </div>

        @foreach ($experiences->chunk(3) as $chunked_data)
         <div class="row hidden-md-up my-2">
            @foreach ($chunked_data as $experience)
              <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" style="height: 22rem"  src="{{asset('storage/'.$experience->photo_attachment)}}" alt="Feedback experience">
                    <div class="card-body p-4">
                        <h4 class="card-title">{{$experience->name}}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">{{$experience->email}}</h6>
                      <p class="card-text p-y-2">
                        {{$experience->description}}
                        </p>
                        <p class="my-2 text-muted" style="font-size: 12px"><i>@lang('Created') : {{$experience->created_at->diffForHumans()}}</i></p>
                        @auth
                        <form action="{{route('experience.destroy',$experience->id)}}" method="POST">
                           <button class="btn btn-danger">@lang('DELETE')</button>
                           @method('DELETE')
                          @csrf
                       </form>
                        @endauth
                    </div>
                  </div>
              </div>

            @endforeach

        @endforeach

        <div class="ml-3">
            {{ $experiences->links() }}
        </div>

        @include('modals.newExperience')

      </div>


</div>
@endsection
@section('scripts')
<script>
       $(document).ready(function(){
        $('#input1').on('change',function(){
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })

    $("#saveExperience").on('submit',function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{route('experience.store')}}",
            method: "POST",
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data) {
                if($.isEmptyObject(data.error)){
                    console.log(data);
                        alert(data.success);
                        $('#newExperience').modal('toggle');

                    }else{
                        printErrorMsg(data.error);
                    }
                },
        });
    });

    function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

       });


</script>
@endsection
