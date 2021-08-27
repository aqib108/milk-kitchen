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
            <!-- Add Permission Modal -->
            {{-- <div class="modal fade" id="addCustomer" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('customer.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Customer Name..."
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Enter Customer Email..." value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password"
                                        placeholder="Enter Customer Password..." required>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="text" class="form-control" name="password_confirmation"
                                        placeholder="Enter Confirm Password..." required>
                                    @error('confirm_password')
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
            </div> --}}
            <!-- End Customer Model -->
            <!-- Update Customer Modal -->
            <div class="modal fade" id="updateCustomer" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formID" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control Cname" name="name"
                                        placeholder="Enter Customer Name...">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control Cemail" name="email"
                                        placeholder="Enter Customer Email...">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="mb-3 error-placeholder">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control Cpassword" name="password"
                                        placeholder="Enter Customer Password...">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
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
    </script>
    <script src="{{ asset('js1/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("body").on("click", ".editCustomer", function() {
                let id = $(this).attr("data-id");
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });
                $.ajax({
                    type: "get",
                    url: "customer/edit/" + id,
                    dataType: "json",
                    beforeSend: function() {
                        $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function(response) {
                        console.log(response);
                        $("#updateCustomer .Cname").val(response.name);
                        $("#updateCustomer .Cemail").val(response.email);
                        // $("#updateCustomer .Cpassword").val(response.password);
                        $("#formID").attr("action", "customer/update/" + id);
                        $("#updateCustomer").modal("show");
                    },
                    error: function(response) {},
                    complete: function() {
                        $(".loader-wrapper").fadeOut("slow");
                    }
                });
            });

            // Delete Records
            $("body").on("click", ".del_btn", function() {
                let id = $(this).attr("data-id");
                let url = $(this).attr("data-url");
                let tableName = $(this).attr("data-tab");
                swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover this again!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function() {
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            }
                        });
                        $.ajax({
                            type: "DELETE",
                            url: url + "/" + id,
                            dataType: "json",
                            beforeSend: function() {
                                $(".loader-wrapper").fadeIn("slow");
                            },
                            success: function(response) {
                                swal({
                                    title: "Deleted!",
                                    text: response.message,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonClass: "btn-primary successfully_delete",
                                    confirmButtonText: "OK",
                                    closeOnConfirm: false
                                });
                            },
                            error: function(response) {},
                            complete: function() {
                                $(".loader-wrapper").fadeOut("slow");
                                $("#" + tableName)
                                    .DataTable()
                                    .ajax.reload();
                            }
                        });
                    }
                );
            });
        })
    </script>

@endsection
{{-- <script src="{{ asset('js1/sweetalert.min.js') }}"></script>
<script src="{{ asset('js1/custom.js') }}"></script> --}}
