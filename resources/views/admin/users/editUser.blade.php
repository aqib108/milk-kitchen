@extends('admin.layouts.admin')
@section('page_title')
    Edit User
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="btn btn-dark">Back</a>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control" id="firstName" name="name" value="{{ $user->name }}" placeholder="Enter User Name" readonly>
                                        <div id="first-name-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Email <span class="required-star">*</span></label>
                                        <input type="email" maxlength="50" class="form-control" id="emailAddress" name="email" value="{{ $user->email }}" placeholder="Enter Email " readonly>
                                        <div id="email-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Role's <span class="required-star">*</span></label>
                                        <select name="role" class="form-control" id="role_id">
                                            @foreach ($roles as $role) 
                                                <option @if ($role->id == $user->roles[0]->id) selected @endif
                                                    value="{{$role->id}}">{{$role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden" id="assign_warehouse">

                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden" id="assign_drivers">
                                              
                                              </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden"  id="driver">
                                        <label>Driver Code<span class="required-star">*</span></label>
                                        <input type="text"  class="form-control driver"  name="driver_code" minlength="4" maxlength="4" placeholder="Enter 4-Digit Code Driver" value="{{$user->driver_code}}">
                                        <div id="digit-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50"
                                            class="form-control" name="password"  id="password"
                                            placeholder="Update Password " >
                                            <div id="password-err" class="alert alert-danger"></div>
                                    </div>
                                    <input type="hidden" id="user_id" value="{{$user->id}}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        // Page On Load Request //
        window.onload = function() {
            var role_id = $('#role_id').val();
            var user_id =$('#user_id').val();
            // Warehouse Manager Assigned Warehouse Get //
            if(role_id == 4)
            {
                $.ajax({
                    method: "get",
                    url: "{{route('getWarehouses')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        role_id: role_id,
                        user_id: user_id,
                    },
                    success: function(response) {
                        $('#assign_warehouse').removeClass('hidden'); 
                        $('#driver').addClass('hidden');
                        $('#assign_warehouse').empty();
                        $('#assign_warehouse').append(response.html);
                    }
                });
            }
            // Driver Assigned Warehouse Get //
            else if(role_id == 5)
            {
                $('#driver').removeClass('hidden'); 
                $.ajax({
                    method: "get",
                    url: "{{route('getWarehouses')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        role_id: role_id,
                        user_id: user_id,
                    },
                    success: function(response) {
                        $('#drivers').removeClass('hidden'); 
                        $('#assign_drivers').removeClass('hidden'); 
                        $('#assign_drivers').empty();
                        $('#assign_drivers').append(response.html);
                    }
                });
            }  
        }
        // Driver 4-Digit Code Assigined By Role OR Warehouse 
        $('#role_id').on('change', function() {
          
            var role_id = $('#role_id').find(":selected").val();
            var user_id =$('#user_id').val();
            // Role On-Change Driver //
            if(role_id == 5)
            {
                $('#driver').removeClass('hidden');
                $.ajax({
                    method: "get",
                    url: "{{route('getWarehouses')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        role_id: role_id,
                    },
                    success: function(response) {
                        $('#drivers').removeClass('hidden'); 
                        $('#assign_drivers').removeClass('hidden'); 
                        $('#assign_drivers').empty();
                        $('#assign_drivers').append(response.html);
                    }
                });
            }
            else
            {
                $('#driver').addClass('hidden');
                $('#assign_drivers').addClass('hidden'); 
            }
            // Role On-Change WareHouse Manager //
            if(role_id == 4)
            {
                $.ajax({
                    method: "get",
                    url: "{{route('getWarehouses')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        role_id: role_id,
                    },
                    success: function(response) {
                        $('#assign_warehouse').removeClass('hidden'); 
                        $('#driver').addClass('hidden');
                        $('#assign_warehouse').empty();
                        $('#assign_warehouse').append(response.html);
                    }
                });
            }
            else
            {
                $('#assign_warehouse').empty();  
            }
        });
        
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Select2 select box
            $("select[name=\"validation-select2\"]").select2({
                allowClear: true,
                placeholder: "Select gear...",
            }).change(function() {
                $(this).valid();
            });
            // Initialize Select2 multiselect box
            $("select[name=\"validation-select2-multi\"]").select2({
                placeholder: "Select gear...",
            }).change(function() {
                $(this).valid();
            });
        });
    </script>
@endsection