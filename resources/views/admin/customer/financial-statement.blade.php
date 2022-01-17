@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <div class="container">
    @php 
        $v=0;$t=0;
        $paidd=App\Models\AllocatePayment::where('customerId',$id)->whereReversed(0)
        ->where('start',$start)->where('end',$end)->get();
        $reversed=App\Models\AllocatePayment::where('customerId',$id)->whereReversed(1)
        ->where('start',$start)->where('end',$end)->get();
           $name=App\Models\User::whereId($id)->first()->name;
           $plannedPayments=App\Models\PlannedPayment::whereCustomerId($id)->get();
           $subt =$paidd->sum('amount');
     @endphp
     <div>
            <div class="text-center">
                <h2 class="heading-wrapper">Statement Financials Week({{$start}} -- {{$end}})</h2>
            </div>
        </div>
     <section class="content-header allign-center">
        <div class="container-fluid">
            <!-- <div class="row mb-2 ml-5">
                <div class="col-sm-12">
                    <h1>Allocate Customer Payment of Week({{$start}} -- {{$end}})</h1>
                </div>
            </div> -->
             <div class="row-md-12">
                <form action="{{route('saveAllocatePayment')}}" method="POST">
                    @csrf
                <div class="col-8" style="margin-left: 10%;">
                      <label for="">Name</label>
                      <input type="text" value="{{$name}}" class="form-control" disabled>
                  <label for="" class="control-label">Total Payment</label>
                  <input type="text" value="{{round(($total-$subt),2)}}"  class="form-control" disabled>
                  <label for="" class="control-label">Assign Payment</label>
                  <input type="hidden" name="start" value="{{$start}}">
                  <input type="hidden" name="end" value="{{$end}}">
                  <input type="hidden" name="customerId" value="{{$id}}" required>
                  <input type="text"  name="amount" class="form-control mb-3">
                   <input type="submit" value="submit" class="form-control button" style="background-color: #94d60a;">
                  </div>
                </form>
             </div>
        </div><!-- /.container-fluid -->
    </section>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="table-th-wrapper" scope="col">Transaction</th>
                        <th class="table-th-wrapper" scope="col">Date</th>
                        <th class="table-th-wrapper" scope="col">Balance</th>
                        <th class="table-th-wrapper" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="week-container-tbl">
                  
                            <tr>   
                                <td>
                                Statement Value                         
                                </td>
                                <td>
                                
                                </td>
                                <td>
                                  {{round($total,2)}}
                                </td> 
                            </tr>
                            
                                @foreach($paidd as $p)
                                <tr>   
                                        <td>
                                    Payment Received                         
                                        </td>
                                        <td> 
                                        {{date($p->updated_at->format('Y-m-d h:i'))}}
                                        </td>
                                        @php $v += ($p->amount); @endphp
                                        <td >
                                        {{-$p->amount}}
                                        </td>
                                        <td>
                                            <a href="#" class="button bt-danger" data-time="{{date($p->updated_at->format('H:i:s'))}}"  data-date="{{date($p->updated_at->format('Y-m-d'))}}" data-customer ="{{$id}}">Reversal</a>
                                        </td>
                                    
                                    </tr>
                                @endforeach
                                @foreach($reversed as $p)
                                <tr>   
                                        <td>
                                    Reversed                       
                                        </td>
                                        <td> 
                                        {{date($p->updated_at->format('Y-m-d h:i'))}}
                                        </td>
                                        <td >
                                        {{$p->amount}}
                                        </td>
                                        <td>
                                            <!-- <a href="#" class="button bt-danger" data-time="{{date($p->updated_at->format('H:i:s'))}}"  data-date="{{date($p->updated_at->format('Y-m-d'))}}" data-customer ="{{$id}}">Reversal</a> -->
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($plannedPayments as $p)
                                <tr>   
                                    
                                        <td>
                                    Planned Payment                       
                                        </td>
                                        <td> 
                                        {{$p->date}}
                                        </td>
                                        @php $t += ($p->amount); @endphp
                                        <td>
                                        {{$p->amount}}
                                        </td>
                                        <td>
                                            <!-- <a href="#" class="button bt-danger" data-time="{{date($p->updated_at->format('H:i:s'))}}"  data-date="{{date($p->updated_at->format('Y-m-d'))}}" data-customer ="{{$id}}">Reversal</a> -->
                                        </td>
                                    
                                    </tr>
                                @endforeach
                            <tr>   
                                <td>
                              Add Planned Payment                       
                                </td>
                                <form id="planned_payment" method="POST">
                                <td>
                                    <input type="hidden" name="customer_id" value="{{$id}}">
                                    <input type="date" name="date" id="planned_date" min="{{date('Y-m-d h:i')}}" required>
                                </td>
                                <td>
                                  <input type="number" name="amount" id="amount" required>
                                </td>
                                <td>
                                <input type="submit" class="button bt-success" value="submit">
                                </td> 
                                </form>
                            </tr>
                            <tr>   
                                <td>                      
                                </td>
                                <td>
                                Balance Owing
                                </td>
                                <td>
                                 {{round(($total-$v),2)}}                             
                                </td> 
                            </tr>
                            <tr>   
                                <td>                      
                                </td>
                                <td>
                                Planned Payments
                                </td>
                                <td>
                                 {{$t}}                             
                                </td> 
                            </tr>
                            <tr>   
                                <td>                      
                                </td>
                                <td>
                                Unplanned Balance
                                </td>
                                <td>
                                 {{round(($total-$v-$t),2)}}                             
                                </td> 
                            </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function()
        {
                    var region_name ='';
                    region_name =`<?php echo $customerDetail->delivery_region ?? '' ;?>`;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                 //Payment Reversal Functionality
                
                $("body").on("click", ".button", function ()
                {
                    let amount = $(this).attr('data-amount');
                    let time = $(this).attr('data-time');
                    let date = $(this).attr('data-date');
                    let customer = $(this).attr('data-customer');
                            $.ajax({
                                method: "GET",
                                url: '{{ route("reverse_payment")}}',
                                data: {
                                    'customer':customer,
                                    'date':date,
                                    'time':time,
                                },
                                success: function (response) {
                                    if(response.success)
                                    {
                                        $('#submit').hide();
                                        Swal.fire({
                                            position: 'top-end',
                                            toast: true,
                                            showConfirmButton: false,
                                            timer: 2000,
                                            icon: 'success',
                                            title: response.success,
                                        });
                                        location.reload();
                                    }
                                },
                            }); 
                });

                   //Payment Allocation Functionality
                    $("#planned_payment").on("submit", function(event){
                        event.preventDefault();
                        var formData = new FormData(this);
                        $.ajax({
                            method: "POST",
                            data: formData,
                            url: "{{route('planned_payment')}}",
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (response) {
                                if(response.success)
                                {
                                    $('#submit').hide();
                                    Swal.fire({
                                        position: 'top-end',
                                        toast: true,
                                        showConfirmButton: false,
                                        timer: 2000,
                                        icon: 'success',
                                        title: response.success,
                                    });
                                    location.reload();
                                }
                            },
                        }); 
                    });
        });
        </script>
        @endsection