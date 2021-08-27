@extends('admin.layouts.admin')
@section('page_title')
    Add New User
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Add User</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New User</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter User Name..." value="{{ old('name') }}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" id="email"
                                            placeholder="Enter User Email...">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}"
                                            placeholder="Enter User Password...">
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirm"  value="{{ old('password_confirmation') }}" 
                                            placeholder="Enter password again...">
                                        @error('confirm_password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Role's</label>
                                        <select name="role" class="form-control" id="" >
                                            @foreach ($roles as $roll)
                                                <option value="{{ $roll->name }}"  selected="{{ old('roll->name') }}">{{ $roll->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="mb-3 error-placeholder">
                                    <label class="form-label">Select2 Multiple</label>
                                    <div class="d-flex">
                                        <select class="form-control" name="validation-select2-multi" multiple
                                            style="width: 100%">
                                            <option value="pitons">Pitons</option>
                                            <option value="cams">Cams</option>
                                            <option value="nuts">Nuts</option>
                                            <option value="bolts">Bolts</option>
                                            <option value="stoppers">Stoppers</option>
                                            <option value="sling">Sling</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 ">
                                    <div class="float-end">
                                        {{-- <button class="btn btn-primary">Back</button> --}}
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
