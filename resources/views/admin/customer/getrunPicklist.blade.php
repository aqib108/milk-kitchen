<div class="col-lg-12">
    <h2 class="heading-tbl">Warehouses Picklist</h2>
</div> <br>
 <div class="row">
    <div class="col-md-4">
        <div class="warehouse border text-center">
            <h3 class="table-th-wrapper">Warehouse</h3>
            <p>{{$warehouse->name}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="warehouse border text-center">
            <h3 class="table-th-wrapper">Assigned By Driver</h3>
            <p>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <select class="form-control" name="assigned_driver" id="assigned_driver_id" disabled onchange="assignByDriver(this.value)">
                            <option selected disabled style="text-align: center;">-- Assigned By Driver --</option>
                            @foreach ($data as $driver)
                                <option value="{{$driver->id}}">{{$driver->driverName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </p> 
        </div>
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
                    <th class="table-th-wrapper" scope="col">CUSTOMER</th>
                    <th class="table-th-wrapper" scope="col">ADRESS</th>
                    <th class="table-th-wrapper" scope="col">SUBRUB</th>
                    <th  class="table-th-wrapper"scope="col">CARTONS</th>
                    <th  class="table-th-wrapper"scope="col">Assign By Driver</th>
                </tr>
            </thead>
            <tbody class="week-container-tbl">
               
                @foreach($orders as $customer)  
                    @if(!empty($customer))
                        <tr>
                            <td class="table-td-wrapper" scope="row">
                                <div class="row">
                                    @if($customer['assign_driver'] != false)
                                        <div class="col-md-4" style="margin-bottom: 23px;">
                                            
                                        </div>
                                    @else
                                        <div class="col-md-4" style="margin-bottom: 23px;" >
                                            <input type="checkbox" class="form-check-input abcd customer-{{$customer['user_id']}}"  data-target="customer-{{$customer['user_id']}}" onclick="checkBox('{{$customer['user_id']}}');" name="customer[]" value="{{$customer['user_id']}}">
                                        </div>
                                    @endif
                                    <div class="col-md-4" style="text-align: center;">
                                        {{$customer['userName']}}
                                    </div>
                                </div> 
                            </td>
                            <td>{{$customer['userAddress']}}</td>
                            <td>{{$customer['userRegion']}}</td>
                            <td>{{$customer['qty']}}</td> 
                            @if($customer['assign_driver'] != false)
                                <td>{{$customer['assign_driver']}}</td>
                            @else
                                <td>-- --</td>
                            @endif
                        </tr>
                    @else
                        <tr>
                            <td class="alert alert-danger" colspan="5" role="alert">
                                <div>
                                    No Result(s) Found !
                                </div>
                            </td>
                        </tr>
                    @endif  
                @endforeach
            </tbody>
        </table> 
    </div>
</div>
<script>
    function checkBox(customer_id) {
        var customer_id =
        $("input[name='customer[]']:checked").map(function()
            {
                return $(this).val();
            }
            ).get();
        $("#assigned_driver_id").removeAttr('disabled'); 
        
    }
    function assignByDriver(driver_id) {
        var customer_id =
            $("input[name='customer[]']:checked").map(function()
                {
                    return $(this).val();
                }
                ).get();
        $.ajax({
            method: "POST",
            url: '{{route('selectCustomer')}}',
            dataType:'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'customer_id[]': customer_id,
                'driver_id': driver_id,
            },
            beforeSend: function(){
                $(".custom-loader").removeClass('hidden');
            },
            success: function (response) {
                if(response.status == 200){
                    $(".custom-loader").addClass('hidden');
                    location.reload(); 
                }
                else{
                    $(".custom-loader").removeClass('hidden');
                }     
            }
        }); 
    }
</script>