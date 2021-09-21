<!-- Add WareHouse Modal -->
<div class="modal fade" id="addWarehouse" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Warehouse</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="{{ route('warehouse.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Warehouse Name</label>
                        <input type="text" class="form-control" name="warehouse_name" placeholder="Enter Warehouse Name..." required>
                        @error('warehouse_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save & Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End  WareHouse Model -->
<!-- Edit Warehouse  Modal -->
<div class="modal fade" id="updateWarehouse" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Warehouse</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="form">

            </div>
        </div>
    </div>
</div>
<!-- End Edit Warehouse Model -->