@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Weekly Automated Direct Debiting Of bank Accounts</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="table-th-wrapper" scope="col">Week</th>
                        <th class="table-th-wrapper" scope="col">Statement Value</th>
                        <th class="table-th-wrapper" scope="col">Payment Date</th>
                        <th class="table-th-wrapper" scope="col">Export File to Deduct Money</th>
                        <th class="table-th-wrapper" scope="col">Manual Payment Allocation </th>
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
                                    {{ date('Y-m-d', strtotime($value['end']. ' + 10 days'))}}
                                </td>
                                <td>
                                <a href="{{route('sale.csv',['start'=>$value['start'],'end'=>$value['end']])}}"><img src="https://img.icons8.com/material-two-tone/24/000000/export-csv.png"/></a>
                                </td>
                                <td>
                                <img src="https://img.icons8.com/fluency-systems-regular/48/000000/import-file.png"/>
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
