    <!-- Modal for wish decline  -->
    <div class="modal fade" id="decline-modal_{{$wish->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('Decline') {{$wish->name}} @lang(' wish')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('decline-request')}}" method="POST">
                    @csrf
                    <input type="hidden" name="wish_id" value="{{$wish->id}}">
                    <div class="form-group mb-2">
                        <label for="decline_reason">@lang('Reason for declining this wish')</label>
                        <textarea class="form-control" name="decline_reason" id="decline_reason" rows="3"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Cancel')</button>
            <button class="btn btn-primary" type="submit">@lang('Decline')</button>
            </div>
        </form>
        </div>
        </div>
    </div>
