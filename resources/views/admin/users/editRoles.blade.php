@extends('admin.layouts.admin')
@section('page_title')
    Edit Role's
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Update Role</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update Role</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('role.update', $role->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Role</label>
                                        <input type="text" name="role" class="form-control" value="{{ $role->name }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Select permission's</label>
                                        <div class="d-flex">
                                            <select class="form-control" name="permissions[]" multiple style="width: 100%">
                                                @foreach ($permission as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ in_array($value->id, $rolePermissions) ? 'selected' : false }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="float-end">
                                        {{-- <button class="btn btn-primary">Back</button> --}}
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

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
            $("select[name=\"permissions[]\"]").select2({
                placeholder: "Select Permissions...",
            }).change(function() {
                $(this).valid();
            });
        });
    </script>
@endsection
