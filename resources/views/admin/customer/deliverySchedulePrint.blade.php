
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MILK KITCHEN</title>
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
   
</head>
<body>
    @php $total =0;@endphp
            <section style="background-color: #757170; padding: 6px 0; height:60px !important;">
                <div class="">
                    <div class="flex-wraper" style="display:flex;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        align-self: center;
                    ">
                        <div>
                            <img src="{{asset('images/logo.png')}}" style="width: 200px; height:50px; background-color:grey" class="img-fluid" alt="">
                        </div>
                        <div style="position: relative; float: right;">
                            <h2 class="heading-one-banner" style=" margin: 0px; margin-top: 16px; font-size: 20px; color: #ffffff;
                            font-weight: 400;
                            font-size: 20px;
                            color: #ffffff;
                            font-weight: 400;
                            text-align: left;
                            text-transform: lowercase;
                            ">Delivery Schedule</h2>
                        </div>
                        
                    </div>


                </div>
            </section>
            <!--  -->
            <!--  -->
            <div class="row mb-40-wrapper">
                <div class="col-lg-12">
                    <h2 class="heading-tbl" style="margin-left: 10px;">Delivery Schedule</h2>
                </div>
                <div class="col-lg-12 mt-5">
                <h6 class="heading-tbl container" style="margin-left: 10px;">  <b>Run::</b>   {{$zone}}</h6>
                    <h6 class="heading-tbl container" style="margin-left: 10px;"> <b>Delivery Date And Day::</b>        ({{date('l')}}  {{date('Y-m-d')}})</h6>
                </div>
                
                    <div class="table-responsive" style="width: 80%">
                        <table class="table table-bordered mb-0" style="position: relative; left: 3%;">
                        <thead>
                                        <tr>
                                            <th class="table-th-wrapper" scope="col">Del Name</th>
                                            <th class="table-th-wrapper" scope="col">#Cartons</th>
                                            <th class="table-th-wrapper" scope="col">Del Address1</th>
                                            <th class="table-th-wrapper" scope="col">Del Address2</th>
                                            <th class="table-th-wrapper" scope="col">Del Subrub</th>
                                        </tr>
                                    </thead>
                                    <tbody class="week-container-tbl">
                                        @foreach ($products as $product1)
                                        @php $customer=App\Models\CustomerDetail::where('user_id',$product1->id)->first();
                                            
                                        @endphp
                                        <tr class="week_days_1">
                                            <td class="table-td-wrapper" scope="row" style="background-color: white !important; width: 120px; text-align:center;">
                                                {{ $customer->delivery_name }}
                                            </td>
                                            <td style="background-color: white !important; width: 120px; text-align:center;">
                                                <div class="quantity">
                                                    {{ $product1['carton'] }}
                                                </div>
                                                @php $total =$total + $product1['carton'] ; @endphp

                                            </td>
                                            <td style="background-color: white !important; width: 120px; text-align:center;">{{$customer->delivery_address_1}}</td>
                                            <td style="background-color: white !important; width: 120px; text-align:center;">{{$customer->delivery_address_2}}</td>
                                            <td style="background-color: white !important; width: 120px; text-align:center;">{{$customer->delivery_region}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                        </table>
                        <!-- <table class="table table-bordered mb-0 weekly_standing_order" style="margin-left: 50px;" >
                            <tbody class="week-container-tbl">
                                <tr>
                                    <th style="width: 375px; text-align: center;">Total Carton</th>
                                    <td id="total_ctns">
                                        {{$total}}
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
    
               
            </div>



        <style>
            * {
  box-sizing: border-box;
}
.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.custom-border-1 p{
    margin-left: 50px;
}
.custom-border-1:after {
  content: '';
  display: block;
  position: relative;
  width: 40%;
  border: 2px solid #00756c;
  left: 30%;

  margin-top: -0px; }
            .main-container{
                width: 50%;
                float: left !important;
            }
            .heading-inner-top{
                font-size:20px;
                color: #383838;
                font-weight: 700;
                font-family: "Roboto-Bold";
            }
            .label-wrapper-custm{
                font-size: 13px;
                    color: #383838;
                    font-weight: 400;
                    font-family: "Roboto-Medium";
                    margin:6px 8px !important;
                }
                .form-container{
                background-color: #f4f4f4;
                padding:0px 30px 30px 30px;
                }
                .border-riht-clr{
                border-right: 1px solid #fff !important;
    }
                    .box1{
                    border:1px solid #ced4da;
                    height: 80px;
                    background-color: #fff;
    
                    }
                    .heading-tbl{
                    font-size: 24px;
                    line-height: 33px;
                    color: #2c2c2c;
                    font-weight: 700;
                    margin: 15px 0;
                    font-family: "Roboto-Bold";

                    }
                    .table-th-wrapper{
                        background-color: #94d60a;
                        font-size: 14px;
                        line-height: 33px;
                        color: #ffffff;
                        font-weight: 700;
                        font-family: "Roboto-Medium";
                        text-align:center !important;
                    }
                    .table-td-wrapper{
                        font-size: 12px;
                        vertical-align: middle !important;
                        color: #0054ff;
                        font-weight: 400;
                        font-family: "Roboto-Bold";
                        }
                        .week-container-tbl tr:nth-child(odd)
                        {
                            background: #fff;
                        }

        </style>
</body>
</html>