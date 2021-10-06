
    <label>Warehouses <span class="required-star">*</span></label>
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
    $(document).ready(function() {
        // Initialize Select2 select box
        $("select[name=\"validation-select2\"]").select2({
            allowClear: true,
            placeholder: "Select gear...",
        }).change(function() {
            $(this).valid();
        });
        // Initialize Select2 multiselect box
        $("select[name=\"warehouses[]\"]").select2({
            placeholder: "Select warehouses...",
        }).change(function() {
            $(this).valid();
        });
    });
</script>
