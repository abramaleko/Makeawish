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
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <form action="{{route('experience.store')}}" id="saveExperience" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="name">@lang('Name')</label>
                    <input type="text" id="name" name="name" class="form-control" aria-label="name" placeholder="@lang('Enter your full name')" >
                </div>

                <div class="form-group mb-2">
                    <label for="Email">@lang('Email')</label>
                    <input type="email" id="email" name="email" class="form-control" aria-label="email" placeholder="@lang('youremail@domain.com')" >
                </div>

                <div class="form-group mb-2">
                    <label for="description">@lang('Details')</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="@lang('Describe your experience and how it has impacted you') ."></textarea>
                  </div>

                <div class="form-group">
                    <label for="file">Upload a picture of what you got from your wish</label>
                    <div class="input-group mb-2">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="input1" name="photo">
                        <label class="custom-file-label" for="input1">Choose file</label>
                      </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
        <button class="btn btn-primary" type="submit" id="save">@lang('Save')</button>
        </div>
    </form>
    </div>
    </div>
</div>
