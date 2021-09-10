@extends('admin.layouts.admin')
@section('title', 'List Of Distributor')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Distributors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addWarehouse"
                                class="btn btn-primary pull-right"><i class="fas fa-fw fa-plus"></i>Add Distributor</button>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Warehouse content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Distributor's List (Total Distributor's : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="distributors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name </th>
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

        </div>
        <!-- /.container-fluid -->
    </section>
    {{-- Models Warehouse --}}
    <!-- Add Customer Group Modal -->
    <div class="modal fade" id="addWarehouse" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Warehouse</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <form action="{{ route('distributor.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Warehouse Name</label>
                            <input type="text" class="form-control" name="warehouse_name"
                                placeholder="Enter Warehouse Name..." required>
                            @error('warehouse_name')
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
    <!-- End  Model -->
    
    <!-- Update Warehouse  Modal -->
    <div class="modal fade" id="updateWarehouse" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Warehouse</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="form">

                </div>
            </div>
        </div>
    </div>
    <!-- Update Warehouse Model -->
     <!-- Regions content -->
     <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Distributor's List (Total Distributor's : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="distributors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name </th>
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

        </div>
        <!-- /.container-fluid -->
    </section>
    {{-- Models Warehouse --}}
    <!-- Add Customer Group Modal -->
    <div class="modal fade" id="addWarehouse" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Warehouse</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <form action="{{ route('distributor.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Warehouse Name</label>
                            <input type="text" class="form-control" name="warehouse_name"
                                placeholder="Enter Warehouse Name..." required>
                            @error('warehouse_name')
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
    <!-- End  Model -->
    <!-- Update Warehouse  Modal -->
    <div class="modal fade" id="updateWarehouse" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Warehouse</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="form">

                </div>
            </div>
        </div>
    </div>
    <!-- Update Warehouse Model -->
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        var table;
        $(document).ready(function() {

            table = $('#distributors').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('distributor.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
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

        // Change Status Distributor
        function changeStatus(id, status) {
            var result =
                Swal.fire({
                    title: "Are you sure Change this Status?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Change it!"
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('distributor.status') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id,
                                'status': status
                            },
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire("Active!", response.message, "success");
                                    $('#distributors').DataTable().ajax.reload();
                                } else {
                                    Swal.fire("Inactive!", response.message, "success");
                                    $('#distributors').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
        };

        $('body').on('click', '.edit', function() {
            let id = $(this).attr('data-id');
            $.ajax({
                method: "GET",
                url: "{{ route('distributor.getdata') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'id': id
                },
                success: function(response) {
                    $('body').find('#updateWarehouse .form').html(response.html);
                    $('#updateWarehouse').modal('show');
                }
            });
        });
    </script>
@endsection
