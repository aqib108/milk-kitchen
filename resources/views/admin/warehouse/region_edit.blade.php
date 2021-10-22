<form action="{{route('region.update',[$region->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <!-- <div class="mb-3 error-placeholder">
            <label class="label-wrapper-custm" for="country">Suburb <span class="required-star">*</span></label>
            <input type="text" maxlength="50" class="form-control @error('country') is-invalid @enderror" name="country" id="country"
            value="{{$region->country}}" placeholder="Enter Country Name" >
            @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> -->
        <div class="mb-3 error-placeholder">
            <label class="label-wrapper-custm" for="region">Region <span class="required-star">*</span></label>
            <input type="text" maxlength="50" class="form-control @error('region') is-invalid @enderror" name="region" id="region"
            value="{{$region->region}}" placeholder="Enter Region Name" >
            @error('region')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3 error-placeholder"> 
            <label class="label-wrapper-custm" for="warehouse_id">Warehouse <span class="required-star">*</span></label>
            <select name="warehouse_id" class="form-control @error('warehouse_id') is-invalid @enderror" id="warehouse_id" >
                <option selected disabled>Select Warehouse</option>
                @foreach($warehouses as $warehouse)                                        
                    <option value="{{$warehouse->id}}"
                    {{$region->warehouse_id == $warehouse->id ? "selected":""}}>{{$warehouse->name}}</option>
                @endforeach
            </select>
            @error('warehouse_id')
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