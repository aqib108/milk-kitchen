@extends('admin.layouts.admin')
@section('title', 'Customers Group')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Group's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <button class="btn btn-primary pull-right" data-bs-toggle="modal"
                                data-bs-target="#addCustomerGroup"><i class="fas fa-fw fa-plus"></i>Add Customer
                                Group</button>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Customer's Group List (Total Group's : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="groupCustomer" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Group Name</th>
                                        <th>Status</th>
                                        <th class="no-sort" style="width: 200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Add Customer Group Modal -->
            <div class="modal fade" id="addCustomerGroup" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Group</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                aria-label="Close">x</button>
                        </div>
                        <form action="{{ route('customer-group.storeGroup') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Group Name</label>
                                    <input type="text" class="form-control" name="group_name"
                                        placeholder="Enter Customer Group Name..." required>
                                    @error('group_name')
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
            <!-- End Customer Group Model -->
            <!-- Update Customer Group Modal -->
            <div class="modal fade" id="updateGroup" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Customer Group</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">x</button>
                        </div>
                        <form id="formID" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Group Name</label>
                                    <input type="text" class="group_name form-control" name="group_name"
                                        placeholder="Enter Customer Group Name..." required>
                                    @error('group_name')
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
            <!-- End Update Customer Model -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        var table;
        $(document).ready(function() {

            table = $('#groupCustomer').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer-group.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'group_name',
                        name: 'group_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(response) {

                    $('#countTotal').empty();
                    $('#countTotal').append(response['json'].recordsTotal);
                }
            });
        });

        function changeStatus(id, status) {
            var result =
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to change the status?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Change it!"
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('customer-group.groupStatus') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id,
                                'status': status
                            },
                            success: function(response) {
                                Swal.fire("Changed!", response.message, "success");
                                $('#groupCustomer').DataTable().ajax.reload();
                            }
                        });
                    }
                });
        };
    </script>
@endsection
