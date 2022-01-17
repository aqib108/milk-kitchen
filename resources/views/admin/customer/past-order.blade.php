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
                        <!-- @if(auth()->user()->hasRole('Admin')) -->
                        <th class="table-th-wrapper" scope="col">Balance Owning</th>
                        <!-- @endif -->
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
                                @php 
                                $price=$value['statementPrice'] + ($value['statementPrice'] * 15) /100;
                                           $totalprice= $price - ($price/ 100) * 10 ;
                                $t=App\Models\AllocatePayment::when('customerId',function($q) use($customer){
                                     return $q->where('customerId',$customer->id);
                                    })->when('start',function($q) use($value){
                                        return $q->where('start',$value['start']);
                                     })
                                    ->when('end',function($q) use($value){
                                        return $q->where('end',$value['end']);
                                    })->whereReversed(0)->get();
                                    $paid=$t->sum('amount');
                                     if($t->isNotEmpty())
                                     {
                                        $date=$t->first()->created_at->format('d-m-Y');
                                     }
                                     else
                                     {
                                         $date = '00-00-0000';
                                     }
                                    $owingPrice=round($totalprice-$paid,2);
                                @endphp
                                </td>
        
                                <td>
                                    @php
                                       
                                        echo '$'.round($totalprice,2);
                                    @endphp
                                </td>
                                <!-- @if(auth()->user()->hasRole('Admin')) -->
                                <td>
                                    <a href="{{route('customer.financial-statement',['id'=>$customer->id,'total'=>$totalprice,'start'=>$value['start'],'end'=>$value['end']])}}" class="view_statements">{{$owingPrice}}</a>
                                </td> 
                                <!-- @endif -->
                                <td>
                                    <a href="{{route('customer.week-statement',['id'=>$customer->id,'start'=>$value['start1'],'end'=>$value['end1'],'region'=>$value['region']])}}" class="view_statements">View</a>
                                </td> 
                                <td>
                                    <a href="javascript:;" class="view_delivery_detail" data-region="{{$value['region']}}" data-startDate="{{$value['start1']}}"
                                    data-endDate="{{$value['end1']}}" >View</a>
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
    <div class="container financials" style="display: none;margin-bottom: 50px;">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Statement Financial</h2>
            </div>
        </div>
        <div class="financials_details">

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
                        $('body').find('.specfic_deliveries .table_details').html(response.html);
                        $('.specfic_deliveries').fadeIn('slow');
                    }
                });
            });
        });
    </script>

@endsection