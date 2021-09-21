<form action="{{route('warehouse.update',[$warehouse->id])}}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3 error-placeholder">
            <label class="form-label">Warehouse Name</label>
            <input type="text" class="form-control" name="warehouse_name" value="{{ $warehouse->name }}"
                placeholder="Enter Warehouse Name..." required>
            @error('warehouse_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update Changes</button>
    </div>
</form>