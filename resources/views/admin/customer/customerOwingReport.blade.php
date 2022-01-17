@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Customer Owing Report</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="table-th-wrapper" scope="col">customer</th>
                        <th class="table-th-wrapper" scope="col">Period</th>
                        <th class="table-th-wrapper" scope="col">Amount</th>
                        <th class="table-th-wrapper" scope="col">Unplanned Amount</th>
                        <th class="table-th-wrapper" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="week-container-tbl">
                           @foreach($supper as  $result)
                            @if(!empty($result))
                            @php $arr1= array();@endphp
                            @foreach($result as $res)  
                            @php
                            $planned=0;
                            $price=$res['price'] + ($res['price'] * 15) /100;
                                           $totalprice1= $price - ($price/ 100) * 10 ; 
                            $t=App\Models\AllocatePayment::when('customerId',function($q) use($res){
                                     return $q->where('customerId',$res['userId']);
                                    })->when('start',function($q) use($res){
                                        return $q->where('start',$res['start1']);
                                     })
                                    ->when('end',function($q) use($res){
                                        return $q->where('end',$res['end1']);
                                    })->whereReversed(0)->get();
                                    $paid=$t->sum('amount');
                                    $totalprice =$totalprice1-$paid;
                            @endphp
                            <tr>   
                                 @if(!in_array($res['name'],$arr1))
                                 @php array_push($arr1,$res['name']); @endphp
                                 <td>
                                {{$res['name']}}                       
                                </td>
                                @else
                                 <td></td>
                                 @endif
                                <td>
                                 {{$res['start']}} - {{$res['end']}}
                                </td>
                                <td>
                                  {{round($totalprice,2)}}
                                </td> 
                                @php
                                $planned=App\Models\AllocatePayment::where('customerId',$res['userId'])->whereReversed(0)
                                       ->where('start','=',$res['start1'])->where('end','=',$res['end1'])->sum('amount'); 
                                @endphp
                                <td>
                                  {{$planned}}
                                </td> 
                                <td>
                                  <a href="{{route('customer.financial-statement',['id'=>$res['userId'],'total' => $totalprice,'start'=> $res['start1'],'end'=> $res['end1']])}}"><b>Assign Payment / Manager</b></a>
                                </td> 
                            </tr>
                            @endforeach
                            @endif
                           @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection