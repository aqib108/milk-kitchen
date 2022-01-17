@extends('admin.layouts.admin')
@section('title', 'List Of Customer')
@section('styles')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Search Deliveries Record</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('customer.customer-report') }}" class="btn btn-dark">Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- 'url'=>route('billing') -->
            <!-- {{ Form::model(array('method' => 'post','id'=>"search-delivery", 'class'=>"form-horizontal form-label-left")) }} -->
            <div class="row">
                <div class="form-group col-sm-4">
                    <select name='warehouse' class="form-control" id="warehouse" placeholder='select Warehouse'>
                        <option selected disabled>Slect WareHouse</option>
                        @foreach($warehouses as $warehouse)
                        @php $selected = ''; @endphp
                        @if($loop->first)
                        @php $selected = 'selected="selected"'; @endphp
                        @endif
                        <option value='{{$warehouse->id}}' {{$selected}}>{{$warehouse->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <select name='day' class="form-control" id="day_id" placeholder='select Day'>
                        <option selected disabled>Slect Day</option>
                        @foreach($days as $day)
                        <option value='{{$day->id}}'>{{$day->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- 
                            <div class="form-group col-sm-3">
                                <br />
                                <button class="btn btn-success search-btn" id="submit_btn" value="search" >Search Deliveries</button>
                            </div> -->
            <!-- {{ Form::close() }} -->
        </div>
    </div>
</div>
<!-- Main content -->

<section class="content">
    <div class="container-fluid">
        <div>
            <p id="deliverRecord">
            </p>
            <br>
        </div>
        <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script>
    window.onload = function() {
        var warehouse_id = $('#warehouse').val();
        masterpicklist(warehouse_id);
    };

    function masterpicklist(warehouseId = null, dayId = null) {
        $.ajax({
            method: "post",
            url: "{{route('getmasterPicklist')}}",
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                id: warehouseId,
                day_id: dayId,
            },
            success: function(response) {
                $('#deliverRecord').empty();
                $('#deliverRecord').append(response.html);
            }
        });
    }
    $(document).ready(function() {
        $('#warehouse,#day_id').on('change', function() {
            var warehouseId = $('#warehouse').val();
        
            var dayId = $('#day_id').val();
            masterpicklist(warehouseId,dayId)

        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('customer-panel/js/index.js') }}"></script>
@endsection