    <!-- Modal for wish details  -->
    <div class="modal fade" id="wish-detail_{{$wish->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('Request details')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-request')}}" method="POST">
                    @csrf
                    <input type="hidden" name="wish_id" value="{{$wish->id}}">
                    <div class="form-group mb-2">
                        <label for="description">@lang('Name')</label>
                        <input type="text" name="name" class="form-control" aria-label="name"  value="{{$wish->name}}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="Email">@lang('Email')</label>
                        <input type="email" name="email" class="form-control" aria-label="email" value="{{$wish->email}}" >
                    </div>

                    <div class="form-group mb-2">
                        <label for="phone_no">@lang('Phone number')</label>
                        <input type="number" name="phone_no" class="form-control" aria-label="phone_no" value="{{$wish->phone_number}}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="empoyee_code">@lang('Employee code')</label>
                        <input type="text" name="employee_code" class="form-control" aria-label="employee_code" value="{{$wish->employee_code}}" >
                    </div>

                    <div class="form-group mb-2">
                        <label for="description">@lang('Description of your wish')</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{$wish->description}}</textarea>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><img src="{{asset('icons/rupee.svg')}}" class="inline" width="11"></span>
                        </div>
                        <input type="number" name="amount" class="form-control" aria-label="Amount" value="{{$wish->amount}}" >
                    </div>

                    {{-- if the wish is granted then show the granted user details --}}
                    @if ($wish->status ==='Granted')
                        <hr>
                        <h5 class="font-weight-bold my-1">@lang('Granted by'): {{$wish->grant_name}}</h5>
                        <h5 class="font-weight-bold my-1">@lang('Email'): {{$wish->grant_email}}</h5>
                        <h5 class="font-weight-bold my-1">@lang('Phone number'): {{$wish->grant_phone_number}}</h5>
                    @endif
                    @if ($wish->status === 'Declined')
                    <hr>
                    <h5 class="font-weight-bold my-1">@lang('Status'): {{$wish->status}}</h5>
                    <h5 class="font-weight-bold my-1">@lang('Reason'): {{$wish->decline_reason}}</h5>

                    @endif
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
            @if ($wish->status ==='Pending approval')
            <button class="btn btn-primary" type="submit">@lang('Save changes')</button>
            @endif
            </div>
        </form>
        </div>
        </div>
    </div>
