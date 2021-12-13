@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Statement Fiancials</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Name</th>

                        @dd($orders)
                        @foreach($orders as $key=> $val)
                        <th>{{$key}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>Test</tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection