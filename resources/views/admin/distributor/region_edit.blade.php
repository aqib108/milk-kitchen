<form action="{{route('region.update',[$region->id])}}" method="POST">
    @csrf
    @method('PUT')
        <div class="modal-body">
        <div class="mb-3 error-placeholder">
                        <label class="label-wrapper-custm" for="business_country_id">Suburb <span class="required-star">*</span></label>
                        <select name="country_id" class="form-control @error('business_country_id') is-invalid @enderror" id="business_country_id">
                            <option selected disabled>Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}"
                            {{$region->country_id == $country->id ? "selected":""}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('business_country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="label-wrapper-custm" for="business_region_id">Region <span class="required-star">*</span></label>
                        <select name="region_id" class="form-control @error('business_region_id') is-invalid @enderror" id="business_region_id">
                            <option selected disabled>Select Region</option>
                            @foreach($states as $country)
                            <option value="{{$country->id}}"
                            {{$region->region_id == $country->id ? "selected":""}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('business_region_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 error-placeholder"> 
                            <label class="label-wrapper-custm" for="business_country_id">Suburb <span class="required-star">*</span></label>
                            <select name="warehouse_id" class="form-control @error('business_country_id') is-invalid @enderror" id="warehouse_id" >
                            <option selected disabled>Select Warehouse</option>
                            @foreach($warehouses as $country)                                        
                                <option value="{{$country->id}}"
                                {{$region->warehouse_id == $country->id ? "selected":""}}>{{$country->name}}</option>
                            @endforeach
                            </select>
                            @error('business_country_id')
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
@section('script')
<script>
     $(document).ready(function() {
      $('#country_id').on('change', function() {
            var country_id = $('#country_id').find(":selected").val();
            var option = '';
            $('#region_id').prop('disabled', false);

            $.ajax({
                method: "POST",
                url: "{{route('getRegions')}}",
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    'country_id': country_id
                },
                success: function(response) {

                    $('#region_id').empty();
                    $('#region_id').append(' <option value="" selected disabled>Select Region</option>');

                    response.regions.forEach(function(item, index) {
                        option = "<option value='" + item.id + "'>" + item.name + "</option>"
                        $('#region_id').append(option);
                    });

                }
            });
        });
     });
        </script>
        @endsection('script')