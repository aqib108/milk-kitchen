@extends('layouts.customer')

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
                @foreach ($order as $item)
                <tr>
                   
                        <td class="table-td-wrapper" scope="row">{{$item->created_at}}</td>
                        <td></td>
                        <td></td>
                        <td></td> 
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection