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
                        @foreach ($value->productscount as $key => $value1)
                     
                          @if(!in_array($key,$arr1))
                          @php array_push($arr1,$key) @endphp 
                          <th class="table-th-wrapper" scope="col">{{$key}}</th>
                          @endif
                        @endforeach
                        @endforeach
                    </tr>
                </thead>
               
                <tbody class="week-container-tbl">
                  
                        @php $count=count($arr1); $arr2=array(); @endphp
                        @foreach ($orders as $key => $value) 
                            <tr>
                            <td>{{$value->name}}</td>
                        @foreach ($value->productscount as $key => $value1) 

                        <!-- @if(!in_array($key,$arr2))
                          @php array_push($arr2,$key) @endphp
                            
                          @endif  -->
                          <!-- @for($i=0; $i<$count ;$i++)
                               @if($arr1[$i] == $key)
                               <td>{{$value1->sum('quantity')}}</td>
                               @break
                               @else
                                 @continue
                                @endif
                          @endfor -->
                          <td>{{$value1->sum('quantity')}}</td>
                        @endforeach
                            </tr>
        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection