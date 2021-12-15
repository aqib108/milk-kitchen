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
                        @php $arr1=array(); @endphp
                        @foreach ($orders as $key => $value)
                            <th class="table-th-wrapper" scope="col">{{ $key }}</th>
                            {{-- @foreach ($value->productscount as $key => $value1)

                                @if (!in_array($key, $arr1))
                                    @php array_push($arr1,$key) @endphp
                                @endif
                            @endforeach --}}
                        @endforeach
                    </tr>
                </thead>

                <tbody class="week-container-tbl">

                    @php
                        $count = count($arr1);
                        $arr2 = [];
                    @endphp
                    {{-- @dd($orders) --}}
                    @foreach ($orders as $key => $value)

                    <tr>
                        @foreach ($value as $item)
                            {{-- @dd($item) --}}
                                <td>{{ $item->product->name }}</td>
                                <td>{{$item->sum('quantity')}}</td>
                                @endforeach
                            </tr>
                                {{-- @dd($value) --}}
                        {{-- <tr> --}}
                            {{-- @if (!empty($value->productscount))
                                @foreach ($value->productscount as $key => $value1)
                                    <td>{{ $value1->sum('quantity') }}</td>
                                @endforeach

                            @else
                                <td>dd</td>
                            @endif --}}
                        {{-- </tr> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
