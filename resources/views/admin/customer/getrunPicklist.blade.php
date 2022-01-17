<!-- <div class="col-lg-12">
    <h2 class="heading-tbl">Warehouses Picklist</h2><h2 class="heading-tbl text-right">
    <button style="background-color: #94d60a; color :white"> <a href="{{ route('batchPickists',['id'=>$warehouse->id]) }}"> Print Picklists</a>  </button>  
    </h2>
</div> <br> -->

<div class="row">
    <div class="col-md-4">
        <div class="warehouse border text-center">
            <h3 class="table-th-wrapper">Warehouse</h3>
            <p>{{$warehouse->name}}</p>
        </div>
    </div>
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="warehouse border text-center">
            <h3 class="table-th-wrapper">Delivery Date</h3>
            <p>{{date('m/d/Y', strtotime($date))}} - <b>({{$current_day}})</b></p>
        </div>
    </div>
</div>
<div class="row py-3">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- <th class="table-th-wrapper" scope="col">CUSTOMER</th>
                    <th class="table-th-wrapper" scope="col">ADRESS</th> -->
                    <th class="table-th-wrapper" scope="col">Run</th>
                    <th class="table-th-wrapper" scope="col">Carton #</th>
                    <th class="table-th-wrapper" scope="col">Delivery #</th>
                    <th class="table-th-wrapper" scope="col">Picklist</th>
                    <th class="table-th-wrapper" scope="col">Del Schedule</th>
                    <th class="table-th-wrapper" scope="col">Packing Slips</th>
                </tr>
            </thead>
            <tbody class="week-container-tbl">
              @if(isset($products))
               @foreach($products as $product)
               <tr>
                    <td>{{$product['zoneName']}}</td>
                    <td>{{$product['carton']}}</td>
                    <td></td>
                    <td>
                    <a href="{{route('runPicklistView',['zoneName'=>$product['zoneName']])}}">
                                   <i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{route('runPicklistPrint',['zoneName'=>$product['zoneName']])}}">
                                   <i class="fa fa-print" aria-hidden="true"></i></a>
                                </td><td>
                                <a href="{{route('deliverySchedulePrint',['zoneName'=>$product['zoneName']])}}">
                                   <i class="fa fa-print" aria-hidden="true"></i></a>
                                </td><td>
                                <a href="{{ route('batchPickists',['zoneName'=>$product['zoneName']]) }}">
                                   <i class="fa fa-print" aria-hidden="true"></i></a>
                                </td>

                </tr>
               @endforeach
                @else
                <tr>
                    <td class="alert alert-danger" colspan="5" role="alert">
                        <div>
                            No Result(s) Found !
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<script>

    function assignByDriver(driver_id) {
        var customer_id =
            $("input[name='customer[]']:checked").map(function() {
                return $(this).val();
            }).get();
        $.ajax({
            method: "POST",
            url: '{{route('selectCustomer')}}',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'customer_id[]': customer_id,
                'driver_id': driver_id,
            },
            beforeSend: function() {
                $(".custom-loader").removeClass('hidden');
            },
            success: function(response) {
                if (response.status == 200) {
                    $(".custom-loader").addClass('hidden');
                    location.reload();
                } else {
                    $(".custom-loader").removeClass('hidden');
                }
            }
        });
    }
</script>