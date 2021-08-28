@extends('admin.layouts.admin')
@section('title', 'List Of Users')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.create') }}" class="btn btn-primary custom-button pull-right"><i
                                    class="fas fa-fw fa-plus"></i>Add User</a>
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
                                Users List (Total User's : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="users" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
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
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#users').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name',name: 'name'},
                    { data: 'email',name: 'email' },
                    {data: 'role',name: 'role'},
                    { data: 'status',name: 'status'},
                    {data: 'action',name: 'action',orderable: false,searchable: false},
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
                text: "You won't be able to revert this!",
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
                        beforeSend: function() {
                            swal.fire({
                                title: "Please Wait..!",
                                text: "Is working..",
                            });
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire("Successfully Change Status!","success");
                                $('#users').DataTable().ajax.reload();
                            }
                        }
                    });  
                }
            });  
        };
    </script>
@endsection