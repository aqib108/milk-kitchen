@extends('admin.layouts.admin')
@section('title', 'List Of Customer')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('customer.newCustomerCreate') }}" class="btn btn-primary pull-right"><i
                                    class="fas fa-fw fa-plus"></i>Add Customer</a>
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
                                Customer's List (Total Customer's : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="Customer" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>View</th>
                                        <th>Status</th>
                                        <th>Created at</th>
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
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#Customer').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer.index') }}",
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'view',
                        name: 'view'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
                    title: "Are you sure change this Status?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Change it!"
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('user.status') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id,
                                'status': status
                            },
                            success: function(response) {
                                if(response.status == 1)
                                    {
                                        Swal.fire("Activated!", response.message, "success");
                                        $('#Customer').DataTable().ajax.reload();
                                    }
                                else{
                                    Swal.fire("Suspended!", response.message, "success");
                                    $('#Customer').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
        };
    </script>
@endsection
