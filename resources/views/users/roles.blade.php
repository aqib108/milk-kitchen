@extends('admin.layouts.admin')
@section('page_title')
    Role's
@endsection

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-3">Role's</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Role's List</h5>
                        {{-- <h6 class="card-subtitle text-muted">This extension provides a framework with common options that can be used with DataTables. See official documentation <a href="https://datatables.net/extensions/buttons/"
                         target="_blank" rel="noopener noreferrer nofollow">here</a>.</h6> --}}
                        <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addRole"><i
                                class="fas fa-fw fa-plus"></i>Add Role</button>
                    </div>
                    <div class="card-body">
                        <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Permission's</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($role_permissions as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $per)
                                                <button class="btn btn-sm btn-info"> {{ $per->name }} </button>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ url('edit-role', $role->id) }}"><i class="align-middle"
                                                    data-feather="edit-2"></i></a>
                                            <a href="{{ url('delete-role', $role->id) }}"><i
                                                    class="align-middle text-danger" data-feather="trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Permission's</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Role Modal -->
        <div class="modal fade" id="addRole" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('create-role') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Role Name...">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 error-placeholder">
                                    <label class="form-label">Select permission's</label>
                                    <div class="d-flex">
                                        <select class="form-control" name="permissions[]" multiple style="width: 100%">
                                            @foreach ($permissions as $value=>$permissions)
                                                <option value="{{ $value }}">
                                                    {{ $permissions }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Role Model -->
    </div>
@endsection

@section('scripts')
    <script>
        // DataTables with Column Search by Text Inputs
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
        document.addEventListener("DOMContentLoaded", function() {
            // Setup - add a text input to each footer cell
            $('#datatables-column-search-text-inputs tfoot th').each(function() {
                var title = $(this).text();
                if (title !== 'Action') {
                    $(this).html('<input type="text" class="form-control" placeholder="Search ' + title +
                        '" />');
                }
            });
            // DataTables
            var table = $('#datatables-column-search-text-inputs').DataTable({
                responsive: true
            });
            // Apply the search
            table.columns().every(function() {
                var that = this;
                $('input', this.footer()).on('keyup change clear', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });
    </script>
    {{-- Form Validation --}}

@endsection
