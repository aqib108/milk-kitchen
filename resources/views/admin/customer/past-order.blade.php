@extends('admin.layouts.admin')
@section('styles')
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
                        <th class="table-th-wrapper" scope="col">Product Name</th>
                        <th class="table-th-wrapper" scope="col">Statement Value</th>
                        <th class="table-th-wrapper" scope="col">Statement</th>
                        <th class="table-th-wrapper" scope="col">Delivery Details</th>
                    </tr>
                </thead>
                <tbody class="week-container-tbl">
                    @if($orders)
                        @foreach ($orders as $key=>$value)
                                @if(!empty($value['productscount']))
                                @foreach ($value['productscount'] as $key => $value1) 
                                    @php 
                                    $date = Carbon\Carbon::parse($key);
                                   $start = $date->startOfWeek()->format('Y-m-d'); // 2016-10-17 00:00:00.000000
                                    $end = $date->endOfWeek()->format('Y-m-d');
                                    $start1 = $date->startOfWeek()->format('d/m'); // 2016-10-17 00:00:00.000000
                                    $end1 = $date->endOfWeek()->format('d/m');
                                    @endphp
                            <tr>
                                <td class="table-td-wrapper" scope="row">

                                {{ $start1}} - {{$end1}} 
                                </td>
                                <td>
                                    {{$value->name}}
                                </td>
        
                                <td>
                                    @php
                                        $price = 0;
                                    
                                        $price=$value1->sum('quantity')* $value->price;
                                      
                                        echo '$'.$price;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{route('customer.week-statement',['id'=> $value->id,'start'=>$start,'end'=>$end,'region'=>$value1->first()->region_name])}}" class="view_statements">View</a>
                                </td> 
                                <td>
                                    <a href="javascript:;" class="view_delivery_detail" data-id="{{$value->id}}" data-region="{{$value1->first()->region_name}}" data-startDate="{{$start}}"
                                    data-endDate="{{$end}}" >View</a>
                                </td> 
                            </tr>
                            @endforeach  
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td class="alert alert-danger" colspan="4" role="alert">
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
    <div class="container specfic_deliveries" style="display: none;margin-bottom: 50px;">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Specific Weeks Deliveries</h2>
            </div>
        </div>
        <div class="table_details">

        </div>
    </div>
@endsection
@section('scripts')
    <script>
         var customerId= `<?php echo $customer->id; ?>`;
        $(document).ready(function(){
            $('body').on('click','.view_delivery_detail',function(){
                let id = $(this).attr('data-id');
                let region = $(this).attr('data-region');
                let start = $(this).attr('data-startDate');
                let  end = $(this).attr('data-endDate');
               
                $.ajax({
                    method: "GET",
                    url: "{{ route('customer.deliveryDetails') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                         'region':region,
                        'customerId':customerId,
                          'start' : start,
                          'end'  : end
                    },
                    success: function(response) {
                        console.log(response);
                        $('body').find('.specfic_deliveries .table_details').html(response.html);
                        $('.specfic_deliveries').fadeIn('slow');
                    }
                });
            });

            
        });
    </script>

@endsection