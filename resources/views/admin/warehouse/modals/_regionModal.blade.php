<!-- Update Region Model -->
<div class="modal fade" id="updateRegion" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Region</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="form">

            </div>
        </div>
    </div>
</div>
<!-- Update Region Model End -->
<!-- Add Region Modal -->
<div class="modal fade" id="addRegion" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Region</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="{{ route('region.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="label-wrapper-custm" for="country_id">Suburb <span class="required-star">*</span></label>
                        <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" id="country_id">
                            <option selected disabled>Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="label-wrapper-custm" for="region_id">Region <span class="required-star">*</span></label>
                        <select name="region_id" class="form-control @error('region_id') is-invalid @enderror"id="region_id">
                        <option selected disabled> Select Region</option>    
                        </select>
                        @error('region_id')
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
                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
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
                    <button type="submit" class="btn btn-success">Save & Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Region Modal End-->