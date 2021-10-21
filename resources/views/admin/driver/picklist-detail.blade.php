@extends('admin.layouts.admin')
@section('title', 'Run Picklist')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12" style="text-align: center">
                <h1><b>Run Picklist</b></h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div>
            <p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="warehouse border text-center">
                            <h3 class="table-th-wrapper">Warehouse</h3>
                            <p>{{$warehouse->wareHouse->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="warehouse border text-center">
                            <h3 class="table-th-wrapper">Run/Zone</h3>
                            <p>{{$zone->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="warehouse border text-center">
                            <h3 class="table-th-wrapper">Delivery Date</h3>
                            <p>{{date('m/d/Y', strtotime($date))}} - <b>({{$current_day}})</p>
                        </div>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table-th-wrapper" scope="col">Product</th>
                                    <th class="table-th-wrapper" scope="col">Total Cartons</th>
                                    <th class="table-th-wrapper" scope="col">Picked</th>
                                </tr>
                            </thead>
                            <tbody class="week-container-tbl">
                                @foreach ($productOrder as $item)
                                    <tr>
                                        <td class="table-td-wrapper" scope="row">
                                           {{$item->name}}
                                        </td>
                                        <td>{{$item->carton}}</td>
                                        <td></td>
                                    </tr>   
                                @endforeach 
                            </tbody>
                        </table> 
                    </div>
                </div>
            </p>
            <br>
        </div>
        <!-- /.container-fluid -->
    </div>
</section>
@endsection