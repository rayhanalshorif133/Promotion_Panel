{{-- Create Modal --}}
<div class="modal fade" id="createPublisher" tabindex="-1" role="dialog" aria-labelledby="createPublisherLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPublisherLabel">
                    Create New Publisher
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('publisher.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="required">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter publisher's full name" required>
                    </div>
                    <div class="form-group">
                        <label for="shortName" class="required">Short Name</label>
                        <input type="text" class="form-control" id="shortName" name="short_name"
                            placeholder="Enter publisher's short name" required>
                            <label for="shortName" class="text-danger required">
                                Space is not allowed. Use underscore (_) instead.
                            </label>
                    </div>
                    <div class="form-group">
                        <label for="status" class="optional">Select status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option selected value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- update Modal --}}
<div class="modal fade" id="updatePublisher" tabindex="-1" role="dialog" aria-labelledby="updatePublisherLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePublisherLabel">
                    Update Publisher
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('publisher.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="publisher_id">
                    <div class="form-group">
                        <label for="updateName" class="required">Full Name</label>
                        <input type="text" class="form-control" id="updateName" name="name"
                            placeholder="Enter publisher's full name" required>
                    </div>
                    <div class="form-group">
                        <label for="updateShortName" class="required">Short Name</label>
                        <input type="text" class="form-control" id="updateShortName" name="short_name"
                            placeholder="Enter publisher's short name" required>
                            <label for="shortName" class="text-danger required">
                                Space is not allowed. Use underscore (_) instead.
                            </label>
                    </div>
                    <div class="form-group">
                        <label for="updateStatus" class="optional">Select status</label>
                        <select class="form-control" name="status" id="updateStatus" required>
                            <option selected value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
