<form action="{{route('zone.update',[$zone->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="mb-3 error-placeholder">
            <label class="form-label"> Name</label>
            <input type="text" class="form-control" name="name" value="{{ $zone->name }}"
                placeholder="Enter Zone Name" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 error-placeholder">
            <label class="label-wrapper-custm" for="region_id">Region <span class="required-star">*</span></label>
            <select name="region_id" class="form-control @error('region_id') is-invalid @enderror" id="region_id">
                @foreach ($regions as $regionName)
                <option @if ($zone->region_id == $regionName->id) selected @endif
                    value="{{$regionName->id}}">{{ $regionName->name }}</option>
                @endforeach
            </select>
            @error('region_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update Changes</button>
    </div>
</form>