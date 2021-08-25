@extends('admin.layouts.admin')
@section('page_title')
    Edit User Info
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Update User Information</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update User</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('updateUser', $user->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter User Name..."
                                            value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            placeholder="Enter User Email..." value="{{ $user->email }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Role's</label>
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
