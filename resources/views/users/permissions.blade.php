@extends('admin.layouts.admin')
@section('page_title')
    Permission's
@endsection

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-3">Permission's</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Permission's List</h5>
                        {{-- <h6 class="card-subtitle text-muted">This extension provides a framework with common options that can be used with DataTables. See official documentation <a href="https://datatables.net/extensions/buttons/"
                         target="_blank" rel="noopener noreferrer nofollow">here</a>.</h6> --}}
                        <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addPermission"><i
                                class="fas fa-fw fa-plus"></i>Add Permission</button>
                    </div>
                    <div class="card-body">

                        <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Permission Name</th>
                                    {{-- <th>Permission's</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($permissions as $per)
                                    <tr>
                                        <td>{{ $per->name }}</td>
                                        {{-- <td>{{ $role->permission->name }}</td> --}}
                                        <td>
                                            {{-- <a href="{{ url('edit-User', $per->id) }}"><i class="align-middle"
                                                    data-feather="edit-2"></i></a> --}}
                                            <a href="javascript:;" class="editPermission" data-id="{{ $per->id }}"><i
                                                    class="align-middle" data-feather="edit-2"></i></a>
                                            <a href="{{ url('delete-permission', $per->id) }}"><i
                                                    class="align-middle text-danger" data-feather="trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Permission Name</th>
                                    {{-- <th>Permission's</th> --}}
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Permission Modal -->
        <div class="modal fade" id="addPermission" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('create-permission') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Permission Name...">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
        <!-- End Permission Model -->

        <!-- Update Permission Modal -->
        <div class="modal fade" id="updatePermission" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formID" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control permission" name="permission"
                                    placeholder="Enter Permission Name...">
                                @error('permission')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Update Permission Model -->
    </div>
@endsection

@section('scripts')
    <script>
        // DataTables with Column Search by Text Inputs
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
