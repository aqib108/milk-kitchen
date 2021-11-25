@extends('admin.layouts.admin')
@section('page_title')
    Add Customer
@endsection
@section('content')
      
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Casual Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="btn btn-dark">Back</a>
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
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Casual Order</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('deliveredProducts') }}" >
                        @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="label-wrapper-custm" for="delivery_zone">Customers<span class="required-star">*</span></label>
                                    <select name="customer" class="form-control @error('zone') is-invalid @enderror" id="customer" required>
                                      <option disabled selected>Select Customer</option>   
                                     @foreach($customers as $customer)          
                                            <option value="{{$customer->id}}">{{$customer->delivery_name}}</option>
                                     @endforeach
                                    </select> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" name="date" value="{{date('Y-m-d')}}" class="form-control" id="date">
                                    </div>
                                </div>
                                 <div class="row">
                                 <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                 <div id="products">
                                    </div>
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


    function getproducts(customerId = null) {
        $.ajax({
            method: "post",
            url: "{{route('getProducts')}}",
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                id: customerId,
            },
            success: function(response) {
                $('#products').empty();
                $('#products').append(response.html);
            }
        });
    }
    $(document).ready(function() {
        $('#customer').on('change', function() {
            var customerId = $('#customer').val();
            getproducts(customerId);
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('customer-panel/js/index.js') }}"></script>
@endsection

