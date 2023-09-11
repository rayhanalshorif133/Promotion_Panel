{{-- Create Modal --}}
<div class="modal fade" id="createCredential" tabindex="-1" role="dialog" aria-labelledby="createCredentialLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCredentialLabel">
                    Create New Credential
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('credentials.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="required">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="title">
                    </div>
                    <div class="form-group">
                        <label for="password" class="required">Password</label>
                        <input type="text" class="form-control" id="password" name="password"
                            placeholder="password">
                    </div> 
                    <div class="form-group">
                        <label for="details" class="required">Details</label>
                        <textarea id="details" class="form-control"  name="details"></textarea>                            
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
<div class="modal fade" id="updateService" tabindex="-1" role="dialog" aria-labelledby="updateServiceLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateServiceLabel">
                    Update Service
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('credentials.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="service_id">
                        <label for="updateName" class="required">Name</label>
                        <input type="text" class="form-control" id="updateName" name="name"
                            placeholder="service name">
                        <label for="name" class="required text-danger">Space not allowed </label>
                    </div>
                    <div class="form-group">
                        <label for="update_traffic_redirect_url" class="required">Traffic Redirect URL</label>
                        <input type="text" class="form-control" id="update_traffic_redirect_url" name="traffic_redirect_url"
                            placeholder="Traffic Redirect URL">
                    </div>
                    <div class="form-group">
                        <label for="updateType" class="optional">Select type</label>
                        <select class="form-control" name="type" id="updateType">
                            <option selected value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="updateStatus" class="optional">Select status</label>
                        <select class="form-control" name="status" id="updateStatus">
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
