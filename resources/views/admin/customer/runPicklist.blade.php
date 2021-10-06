@extends('admin.layouts.admin')
@section('title', 'List Of Customer')
@section('styles')
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
@endsection

@section('scripts')
<script>
       window.onload =function() {
        $.ajax({
            method: "post",
            url: "{{route('getrunPicklist')}}",
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
            },
            success: function(response) {
                $('#deliverRecord').empty();
                $('#deliverRecord').append(response.html);
            }
        });        
       };
    $(document).ready(function() {
         $('#warehouse').on('change', function() {
        var warehouse_id = $('#warehouse').val();
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
    });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('customer-panel/js/index.js') }}"></script>
@endsection