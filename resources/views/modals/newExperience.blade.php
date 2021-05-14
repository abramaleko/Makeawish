<!-- Modal for new experience -->
<div class="modal fade" id="newExperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add your experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{route('experience.store')}}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" aria-label="name" placeholder="Enter your full name" >
                </div>

                <div class="form-group mb-2">
                    <label for="Email">Email</label>
                    <input type="email" name="email" class="form-control" aria-label="email" placeholder="youremail@domain.com" >
                </div>

                <div class="form-group mb-2">
                    <label for="description">Details</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Describe your experience with this system and how it has impacted you."></textarea>
                  </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
    </div>
    </div>
</div>
