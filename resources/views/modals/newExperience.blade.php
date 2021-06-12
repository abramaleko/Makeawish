<!-- Modal for new experience -->
<div class="modal fade" id="newExperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('Add your experience')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{route('experience.store')}}" method="POST">
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
                    <label for="description">@lang('Details')</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="@lang('Describe your experience and how it has impacted you') ."></textarea>
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
