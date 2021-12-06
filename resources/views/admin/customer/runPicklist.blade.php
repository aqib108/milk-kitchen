@extends('admin.layouts.admin')
@section('title', 'List Of Customer')
@section('styles')
<style>
    .custom-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        z-index: 999;
        opacity: 0.9;
    }
    .hidden {
        display: none;
    }
</style>
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Search Delivires Record</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('customer.customer-report') }}" class="btn btn-dark">Back</a>
                    </li>
                    <li class="breadcrumb-item"><a  href="{{ route('batchPickists') }}" class="btn btn-white print" style="color: white; background-color:#94d60a">Print</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
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

            </div>
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
<div class="custom-loader hidden">
    <img src="{{asset('admin-panel/images/ajaxloader.gif')}}" style="width:100px;height:100px">
</div>
@endsection

@section('scripts')

<script>
    window.onload = function() {
        var warehouse_id = $('#warehouse').val();
        runpicklist(warehouse_id);  
    };
    $(document).ready(function() {
        // $('.print').on('click',function () {
        //     window.print();
        // });
        $('#warehouse').on('change', function() {
            var warehouse_id = $('#warehouse').val();
            runpicklist(warehouse_id);   
        });
    });
    
    function runpicklist(warehouse_id = null)
    {
        $.ajax({
                method: "post",
                url: "{{route('getrunPicklist')}}",
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id: warehouse_id,
                },
                success: function(response) {
                    $('#deliverRecord').empty();
                    $('#deliverRecord').append(response.html);
                }
            });
    }  
</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('customer-panel/js/index.js') }}"></script>
@endsection