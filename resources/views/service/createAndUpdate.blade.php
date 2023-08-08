{{-- Create Modal --}}
<div class="modal fade" id="createService" tabindex="-1" role="dialog" aria-labelledby="createServiceLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createServiceLabel">
                    Create New Service
                </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('service.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="required">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="service name">
                        <label for="name" class="required text-danger">Space not allowed </label>
                    </div>
                    <div class="form-group">
                        <label for="traffic_redirect_url" class="required">Traffic Redirect URL</label>
                        <input type="text" class="form-control" id="traffic_redirect_url" name="traffic_redirect_url"
                            placeholder="Traffic Redirect URL">
                    </div>
                    <div class="form-group">
                        <label for="type" class="optional">Select type</label>
                        <select class="form-control" name="type" id="type">
                            <option selected value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="status" class="optional">Select status</label>
                        <select class="form-control" name="status" id="status">
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
            <form action="{{ route('service.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="service_id">
                        <label for="updateName" class="required">Name</label>
                        <input type="text" class="form-control" name="updateName" name="name"
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
