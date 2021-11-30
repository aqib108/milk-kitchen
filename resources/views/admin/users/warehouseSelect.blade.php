   @if($roleId == 4)
    <label>Warehouses <span class="required-star">*</span></label>
    @else
    <label>Zones <span class="required-star">*</span></label>
    @endif
 
    <select class="form-control" name="warehouses[]" multiple style="width: 100%" required>
        @foreach ($warehouses as $value)
        
        <option value="{{ $value->id }}" {{ in_array($value->id,$arr) ? 'selected' : false }}>
            {{ $value->name }}
        </option>
        @endforeach
    </select>
    @error('warehouses')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
<script>
    var roleId =`<?php echo $roleId;?>`;
    $(document).ready(function() {
        // Initialize Select2 select box
        $("select[name=\"validation-select2\"]").select2({
            allowClear: true,
            placeholder: "Select gear...",
        }).change(function() {
            $(this).valid();
        });
        // Initialize Select2 multiselect box
            if(roleId == 4)
            {
                $("select[name=\"warehouses[]\"]").select2({
                    placeholder: "Select warehouses...",
                }).change(function() {
                    $(this).valid();
                });
            }
            else
            {
                $("select[name=\"warehouses[]\"]").select2({
                    placeholder: "Select zones...",
                }).change(function() {
                    $(this).valid();
                });
            }
    });
</script>
