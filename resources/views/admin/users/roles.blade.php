@extends('admin.layouts.admin')
@section('title', 'List Of Roles')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
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
                                Roles List (Total Roles : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="Roles" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Role </th>
                                        <th>Permission</th>
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
            table = $('#Roles').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('role.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false,searchable: false},
                    {data: 'name',name: 'name'},
                    {data: 'permissions',name: 'permissions'},
                    {data: 'action',name: 'action',orderable: false,searchable: false},
                ],
                drawCallback: function(response) {

                    $('#countTotal').empty();
                    $('#countTotal').append(response['json'].recordsTotal);
                }
            });
        });
    </script>
@endsection
