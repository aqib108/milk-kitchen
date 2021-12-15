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
                    <th class="table-th-wrapper" scope="col">Product</th>
                    <!-- @php $arr1=array(); @endphp
                    @foreach ($orders as $key => $value)
                    @foreach ($value->productscount as $key => $value1)

                    @if(!in_array($key,$arr1))
                    @php array_push($arr1,$key) @endphp
                    <th class="table-th-wrapper" scope="col">{{$key}}</th>
                    @endif
                    @endforeach
                    @endforeach -->
                    @php $week = 0; @endphp
                    @for($i=$currentWeek;$i>=$pastWeek;$i--)
                    <th class="table-th-wrapper" scope="col">Week {{++$week}}</th>
                      @endfor
                </tr>
            </thead>
            <tbody class="week-container-tbl">

                @foreach ($orders as $key => $value)
                <tr>
                    <td>{{$value->name}}</td>
                     @php $currentWeek = date('W'); @endphp

                    @foreach ($value->productscount as $key => $value1)

                    @for($i=$currentWeek;$i>=$pastWeek;$i--)
                     @if($i == $key)
                      @php $currentWeek= --$key; @endphp
                     <td>{{$value1->sum('quantity')}}</td>
                        @break
                     @else
                     <td>0</td>
                     @endif
                     @endfor
                    @endforeach
                </tr>
                @endforeach


        </table>
    </div>
</div>
@endsection
