@extends('admin.layouts.admin')
@section('title','Edit Roles')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('role.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
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
                            <h3 class="card-title">Edit Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('role.update', $role->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Role <span class="required-star">*</span></label>
                                        <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ $role->name }}"
                                            readonly>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-4 col-xs-12">
                                        <label>Permission <span class="required-star">*</span></label>
                                        <select class="form-control" name="permissions[]" multiple style="width: 100%" required>
                                            @foreach($permission as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ in_array($value->id, $rolePermissions) ? 'selected' : false }}>
                                                    {{ $value->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('permissions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
        $(document).ready(function() {
            // Initialize Select2 select box
            $("select[name=\"validation-select2\"]").select2({
                allowClear: true,
                placeholder: "Select gear...",
            }).change(function() {
                $(this).valid();
            });
            // Initialize Select2 multiselect box
            $("select[name=\"permissions[]\"]").select2({
                placeholder: "Select Permissions...",
            }).change(function() {
                $(this).valid();
            });
        });
    </script>
@endsection