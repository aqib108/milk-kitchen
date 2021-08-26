@extends('admin.layouts.admin')
@section('title','List Of Attributes')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attributes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('attribute.create')}}" class="btn btn-primary pull-right"><i
                                class="fas fa-fw fa-plus"></i>Add Attributes</a>
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
                                Attribute's List (Total  Attribute's : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="Arrtibutes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Sku</th>
                                        <th>Description</th>
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
        $(document).ready( function () {
            table  = $('#Arrtibutes').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{route('attribute.index')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'size', name: 'size'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'sku', name: 'sku'},
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                drawCallback: function (response) {

                    $('#countTotal').empty();
                    $('#countTotal').append(response['json'].recordsTotal);
                }
            });
        });
        // Change Status Attribute
        function changeStatus(id,status) {
            var result = window.confirm('Are you sure you want to change status ?');
            if (result == false) {
                e.preventDefault();
            }else{

                $.ajax({
                    method: "POST",
                    url: '{{ route('attribute.status') }}',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        'status': status
                    },
                    success: function (response) {
                        if(response.status)
                        {
                            Swal.fire({
                                position: 'center',
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.message,
                            });
                            $('#Arrtibutes').DataTable().ajax.reload();
                        }
                    }
                });
            }
        };

        // Destory Product
        function deleteAttribute(id,event) {
            var result = window.confirm('Are you sure you want to delete this Product?  This action cannot be undone. Proceed?');
            if (result == false) {
                e.preventDefault();
            }else{

                $.ajax({
                    method: "POST",
                    url: "{{ route('attribute.destroy') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (response) {
                        console.log(response)
                        if(response.status == undefined)
                        {
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'error',
                                title: response.message,
                            });

                        }
                        else
                        {
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.message,
                            });
                            $('#Arrtibutes').DataTable().ajax.reload();
                        }

                    }
                });
            }
        };
    </script>
@endsection
