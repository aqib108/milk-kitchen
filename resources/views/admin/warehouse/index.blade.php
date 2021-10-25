@extends('admin.layouts.admin')
@section('title', 'List Of Ware-House')
@section('styles')
    <style>
        .custom-modal .modal-dialog .modal-body {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 18px 19px;
            font-size: 13px;
            }
            .xyz {
            display: block;
            width: 26px;
            height: calc(2.25rem + 2px);
            text-align:center;
            position:relative;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            margin-top: 30px;
        }
        .table1 td, .table1 th {
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            padding: 0px 6px;
        }

        }
    </style>
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Content Header Ware-House (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Warehouses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addWarehouse" class="btn btn-primary pull-right"><i class="fas fa-fw fa-plus"></i>Add WareHouse</button>
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
                                Warehouse's List (Total Warehouse's : <span id="countTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="warehouse" class="table table-bordered table-striped">
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

    <!-- Content Header Region (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Regions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addRegion" class="btn btn-primary pull-right"><i class="fas fa-fw fa-plus"></i>Add Region</button>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Region content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Region's List (Total Region's : <span id="regionTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="regions" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name </th>
                                        <th>Warehouse</th>
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

    <!-- Content Header Zone (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Zones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#addZone" class="btn btn-primary pull-right"><i class="fas fa-fw fa-plus"></i>Add Zone</button>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Zone content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Zone's List (Total Zone's : <span id="zoneTotal">0</span>)
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="zones" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Region</th>
                                        <th>Status</th>
                                        <th>View</th>
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

    @include('admin.warehouse.modals._wareHouseModal')
    @include('admin.warehouse.modals._regionModal')
    @include('admin.warehouse.modals._zoneModal')
@endsection
@section('scripts')
    <!--- WareHouse Work --->
    <script>
        var table;
        $(document).ready(function() {
            table = $('#warehouse').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('warehouse.index') }}",
                columns:
                [
                    {
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
        // Change Status WareHouse
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
                            url: "{{ route('warehouse.status') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id,
                                'status': status
                            },
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire("Active!", response.message, "success");
                                    $('#warehouse').DataTable().ajax.reload();
                                } else {
                                    Swal.fire("Inactive!", response.message, "success");
                                    $('#warehouse').DataTable().ajax.reload();
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
                url: "{{ route('warehouse.getdata') }}",
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
    <!--- Region Work --->
    <script>
        var table;
        $(document).ready(function() {
            table = $('#regions').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('region.index') }}",
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
                        data: 'warehouse_id',
                        name: 'warehouse_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(response) {

                    $('#regionTotal').empty();
                    $('#regionTotal').append(response['json'].recordsTotal);
                }
            });
        });

        // Change Status Region
        function changeRegionStatus(id, status) {
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
                        url: "{{ route('region.status') }}",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            'id': id,
                            'status': status
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                Swal.fire("Active!", response.message, "success");
                                $('#regions').DataTable().ajax.reload();
                            } else {
                                Swal.fire("Inactive!", response.message, "success");
                                $('#regions').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        };

        $('body').on('click', '.region_edit', function() {
            let id = $(this).attr('data-id');
            $.ajax({
                method: "GET",
                url: "{{ route('region.getdata') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'id': id
                },
                success: function(response) {
                    $('body').find('#updateRegion .form').html(response.html);
                    $('#updateRegion').modal('show');
                }
            });
        });
    </script>
    <!-- Zone work -->
    <script>
        var table;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            table = $('#zones').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('zone.index') }}",
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
                        data: 'region_id',
                        name: 'region_id'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'view',
                        name: 'view'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(response) {

                    $('#zoneTotal').empty();
                    $('#zoneTotal').append(response['json'].recordsTotal);
                }
            });
        });
        // Change Status Zone
        function changeZoneStatus(id, status) {
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
                        url: "{{ route('zone.status') }}",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            'id': id,
                            'status': status
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                Swal.fire("Active!", response.message, "success");
                                $('#zones').DataTable().ajax.reload();
                            } else {
                                Swal.fire("Inactive!", response.message, "success");
                                $('#zones').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        };

        function activate(id)
        {
            alert(id);
        }

        $('body').on('click','.view_schedule',function(){
            let id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                method: "GET",
                url: "{{ route('zone.shedule') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'id': id
                },
                success: function(response) {
                    console.log(response);
                    $('body').find('#sheduleZone .weeks').html(response.html);
                    $('#sheduleZone').modal('show');
                }
            });
        });
        

        $('body').on('click', '.zone_edit', function() {
            let id = $(this).attr('data-id');
            $.ajax({
                method: "GET",
                url: "{{ route('zone.getdata') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'id': id
                },
                success: function(response) {
                    console.log(response.html);
                    $('body').find('#updateWarehouse .form').html(response.html);
                    $('#updateWarehouse').modal('show');
                }
            });
        });

        function toggleCheckbox(id,zone,day)
        {
            $.ajax({
                type: "POST",
                url: "{{ route('zone.sheduleChange') }}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    'day_id':day,
                    'zone_id': zone,
                },
                success: function(response) {
                    
                    if (response.status) {
                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 2000,
                            icon: 'success',
                            title: response.message,
                        });
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 2000,
                            icon: 'error',
                            title: response.success,
                        });
                    }
                }
            });
        } 
    </script>
    <script>
        $('#country_id').on('change', function() {
            var country_id = $('#country_id').find(":selected").val();
            var option = '';

            $.ajax({
                method: "POST",
                url: "{{route('getRegions')}}",
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    'country_id': country_id
                },
                success: function(response) {

                    $('#region_id').empty();
                    $('#region_id').append(' <option value="" selected disabled>Select Region</option>');

                    response.regions.forEach(function(item, index) {
                        option = "<option value='" + item.id + "'>" + item.name + "</option>"
                        $('#region_id').append(option);
                    });
                }
            });
        });
    </script>
@endsection