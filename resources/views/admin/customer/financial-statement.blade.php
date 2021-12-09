@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Statement Fiancials</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="table-th-wrapper" scope="col">Transaction</th>
                        <th class="table-th-wrapper" scope="col">Date</th>
                        <th class="table-th-wrapper" scope="col">Balance</th>
                    </tr>
                </thead>
                <p>Week {{$start}} -- {{$end}}</p>
                <tbody class="week-container-tbl">
                  
                            <tr>   
                                <td>
                                Statement Value                         
                                </td>
                                <td>
                            
                                </td>
                                <td>
                                  {{$total}}
                                </td> 
                            </tr>
                            <tr>   
                                <td>
                               Payment Received                         
                                </td>
                                <td>
                            
                                </td>
                                <td>
                                  
                                </td> 
                            </tr>
                            <tr>   
                                <td>
                                Reversal                        
                                </td>
                                <td>
                            
                                </td>
                                <td>
                                  
                                </td> 
                            </tr>
                            <tr>   
                                <td>
                               Planned Payment                       
                                </td>
                                <td>
                            
                                </td>
                                <td>
                                  
                                </td> 
                            </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection