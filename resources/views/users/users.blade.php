@extends('admin.layouts.admin')
@section('page_title')
    User's
@endsection

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-3">User's</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User's List</h5>
                        {{-- <h6 class="card-subtitle text-muted">This extension provides a framework with common options that can be used with DataTables. See official documentation <a href="https://datatables.net/extensions/buttons/"
                         target="_blank" rel="noopener noreferrer nofollow">here</a>.</h6> --}}
                        <a href="{{ url('add-new-user') }}" class="btn btn-primary pull-right"><i
                                class="fas fa-fw fa-plus"></i>Add User</a>
                    </div>
                    <div class="card-body">

                        <table id="datatables-column-search-text-inputs" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Create at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ isset($user->roles[0]->name) ? $user->roles[0]->name : '' }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ url('edit-User', $user->id) }}"><i class="align-middle"
                                                    data-feather="edit-2"></i></a>
                                            <a href="{{ url('delete-user', $user->id) }}"><i
                                                    class="align-middle text-danger" data-feather="trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Create at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
