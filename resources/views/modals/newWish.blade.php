<!-- Modal for new wish -->
<div class="modal fade" id="newWish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('Request for a new wish')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{route('upload-request')}}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="name">@lang('Name')</label>
                    <input type="text" id="name" name="name" class="form-control" aria-label="name" placeholder="@lang('Enter your full name')" >
                </div>

                <div class="form-group mb-2">
                    <label for="Email">@lang('Email')</label>
                    <input type="email" name="email" class="form-control" aria-label="email" placeholder="@lang('youremail@domain.com')" >
                </div>

                <div class="form-group mb-2">
                    <label for="phone_no">@lang('Phone number')</label>
                    <input type="number" name="phone_no" class="form-control" aria-label="phone_no" placeholder="@lang('Enter your phone number')" >
                </div>

                <div class="form-group mb-2">
                    <label for="empoyee_code">@lang('Employee code')</label>
                    <input type="text" name="employee_code" class="form-control" aria-label="employee_code" placeholder="@lang('Enter your employement code number')" >
                </div>

                <div class="form-group mb-2">
                    <label for="description">@lang('Description of your wish')</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="@lang('Describe what do you need').."></textarea>
                  </div>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><img src="{{asset('icons/rupee.svg')}}" class="inline" width="11"></span>
                    </div>
                    <input type="number" name="amount" class="form-control" aria-label="Amount" placeholder="@lang('Enter the amount needed for your need (Optional)')" >
                  </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
        <button class="btn btn-primary" type="submit">@lang('Save')</button>
        </div>
    </form>
    </div>
    </div>
</div>
