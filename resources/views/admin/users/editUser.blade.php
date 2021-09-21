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
                <h1>Add User</h1>
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
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Name <span class="required-star">*</span></label>
                                    <input type="text" maxlength="50" class="form-control" id="firstName" name="name"
                                        value="{{ $user->name }}" placeholder="Enter User Name" readonly>
                                    <div id="first-name-err" class="alert alert-danger"></div>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Email <span class="required-star">*</span></label>
                                    <input type="email" maxlength="50" class="form-control" id="emailAddress"
                                        name="email" value="{{ $user->email }}" placeholder="Enter Email " readonly>
                                    <div id="email-err" class="alert alert-danger"></div>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Role's <span class="required-star">*</span></label>
                                    <select name="role" class="form-control" id="">
                                        <option value="{{ $role[0] }}">{{ $role[0] }}</option>
                                        @foreach ($roles as $roll)
                                            @if ($role[0] != $roll->name)
                                                <option value="{{ $roll->name }}">{{ $roll->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
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
