@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Order History</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="table-th-wrapper" scope="col">Week</th>
                        <th class="table-th-wrapper" scope="col">Statement Value</th>
                        <th class="table-th-wrapper" scope="col">Statement</th>
                        <th class="table-th-wrapper" scope="col">Delivery Details</th>
                    </tr>
                </thead>
                <tbody class="week-container-tbl">
                    <tr>
                        <td class="table-td-wrapper" scope="row"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin-panel/customer-view/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/js/index.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/js/fontawesome.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
@endsection