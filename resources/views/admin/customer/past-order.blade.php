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
                        <th class="table-th-wrapper" scope="col">Statement Value</th>
                        <th class="table-th-wrapper" scope="col">Statement</th>
                        <th class="table-th-wrapper" scope="col">Delivery Details</th>
                    </tr>
                </thead>
                <tbody class="week-container-tbl">
                    @php $arr=array(); @endphp
                    @if($resultant)
                        @foreach ($resultant as $key=>$value)
                            @if(!in_array($value['start'],$arr)) 
                            <tr>
                                @php array_push($arr,$value['start']); @endphp
                                <td class="table-td-wrapper" scope="row">

                                {{ $value['start']}} - {{$value['end']}} 
                                </td>
        
                                <td>
                                    @php
                                        $price=$value['statementPrice'] + ($value['statementPrice'] * 15) /100;
                                           $totalprice= $price - ($price/ 100) * 10 ;
                                        echo '$'.$totalprice;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{route('customer.week-statement',['id'=>$customer->id,'start'=>$value['start'],'end'=>$value['end'],'region'=>$value['region']])}}" class="view_statements">View</a>
                                </td> 
                                <td>
                                    <a href="javascript:;" class="view_delivery_detail" data-region="{{$value['region']}}" data-startDate="{{$value['start']}}"
                                    data-endDate="{{$value['end']}}" >View</a>
                                </td> 
                            </tr>
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
                let region = $(this).attr('data-region');
                let start = $(this).attr('data-startDate');
                let  end = $(this).attr('data-endDate');
               
                $.ajax({
                    method: "GET",
                    url: "{{ route('customer.deliveryDetails') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
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