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
                    @if($orders->count() > 0)
                        @foreach ($orders as $order)
                            <tr>
                                <td class="table-td-wrapper" scope="row">
                                    {{ $order[0]->created_at->subDays(6)->format('d/m')}} - {{$order[0]->created_at->format('d/m')}}
                                </td>
                                <td>
                                    @php
                                        $price = 0;
                                        foreach($order as $arr){
                                            $price += $arr->product->price;
                                        }
                                        echo '$'.$price;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{route('customer.week-statement', $order[0]->id)}}" class="view_statements">View</a>
                                </td> 
                                <td>
                                    <a href="javascript:;" class="view_delivery_detail" data-id="{{ $order[0]->id }}">View</a>
                                </td> 
                            </tr>
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
        $(document).ready(function(){
            $('body').on('click','.view_delivery_detail',function(){
                let id = $(this).attr('data-id');
                $.ajax({
                    method: "GET",
                    url: "{{ route('customer.deliveryDetails') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        'id': id
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