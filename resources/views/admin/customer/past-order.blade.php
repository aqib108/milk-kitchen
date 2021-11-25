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
                    @if($orders)
                        @foreach ($orders as $key=>$value)
                                @if(!empty($value['productscount'][$key]))
                            <tr>
                                <td class="table-td-wrapper" scope="row">
                                    {{ $value['productscount'][$key]->created_at->subDays(6)->format('d/m')}} - {{$value['productscount'][$key]->created_at->format('d/m')}}
                                </td>
                                <td>
                                    @php
                                        $price = 0;
                                    
                                        $price=$value['productscount']->sum('quantity')*$value->price;
                                      
                                        echo '$'.$price;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{route('customer.week-statement', $value['productscount'][$key]->id)}}" class="view_statements">View</a>
                                </td> 
                                <td>
                                    <a href="javascript:;" class="view_delivery_detail" data-id="{{$value['productscount'][$key]->id}}">View</a>
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
                let id = $(this).attr('data-id');
                $.ajax({
                    method: "GET",
                    url: "{{ route('customer.deliveryDetails') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        'customerId':customerId
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