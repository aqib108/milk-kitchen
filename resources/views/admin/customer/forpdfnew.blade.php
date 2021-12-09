
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
@foreach($products as $key=>$product)

        @if($product->isNotEmpty())

        @php
        $id=$product->first()->userId;
        $customer = App\Models\CustomerDetail::whereUserId($id)->first();
        $total=0;
        @endphp
            <section style="background-color: #757170; padding: 6px 0; height:60px !important;">
                <div class="">
                    <div class="flex-wraper" style="display:flex;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        align-self: center;
                    ">
                        <div>
                            <img src="{{asset('images/logo.png')}}" style="width: 200px; height:50px;" class="img-fluid" alt="">
                        </div>
                        <div style="position: relative; float: right;">
                            <h2 class="heading-one-banner" style=" margin: 0px; margin-top: 16px; font-size: 20px; color: #ffffff;
                            font-weight: 700;
                            font-size: 24px;
                            color: #ffffff;
                            font-weight: 700;
                            text-align: center;
                            text-transform: uppercase;
                            margin: 0px 20px;
                            ">FOOD SERVICE PORTAL</h2>
                        </div>
                        
                    </div>


                </div>
            </section>
            <!--  -->
            <section  style="padding:0px !important;">
                <div class="container">
                    <div>
                        <div class="text-center">
                            <h2 style=" font-size: 22px;
                            color: #010101;
                            padding: 10px 0;
                            margin: 0px;    
                            font-weight: 700;
                            font-family: 'Roboto-Bold';
                            text-align: center;">INVOICE / STATEMENT</h2>
                        </div>
                        <div>
                        <div class="form-container pt-4">
                            <div class="row">
                                <div class="main-container border-riht-clr">
                                    <div>
                                        <h2 class="heading-inner-top">
                                            @isset($customer->business_name)
                                            {{ $customer->business_name }}
                                            @endisset
                                        </h2>
                                    </div>
                                    <div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Address 1:
                                                <span>@isset($customer->business_address_1){{ $customer->business_address_1 }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Address 2:
                                                <span>@isset($customer->business_address_2){{ $customer->business_address_2 }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Suburb:
                                                <span>@isset($customer->business_country){{ $customer->business_country }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                City:
                                                <span>@isset($customer->business_city){{ $customer->business_city }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Region:
                                                <span>@isset($customer->business_region){{ $customer->business_region }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Phone No:
                                                <span>@isset($customer->business_phone_no){{ $customer->business_phone_no }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Email:
                                                <span>@isset($customer->business_email){{ $customer->business_email }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Contact No:
                                                <span>@isset($customer->business_contact_no){{ $customer->business_contact_no }}@endisset</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <h2 class="heading-inner-top">
                                            @isset($customer->delivery_name){{ $customer->delivery_name }}@endisset
                                        </h2>
                                    </div>
                                    <div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Address 1:
                                                <span>@isset($customer->delivery_address_1){{ $customer->delivery_address_1 }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Address 2:
                                                <span>@isset($customer->delivery_address_2){{ $customer->delivery_address_2 }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Suburb:
                                                <span>@isset($customer->delivery_country){{ $customer->delivery_country }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                City:
                                                <span>@isset($customer->delivery_city){{ $customer->delivery_city }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Region:
                                                <span>@isset($customer->delivery_region){{ $customer->delivery_region }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                GST Number: <span>33030400923</span>
                                            </p>

                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Invoice Number: <span>33030400923</span>
                                            </p>

                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Period Covered: <span>-------------</span>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-40-wrapper text-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="" class="label-wrapper-custm">Delivery Notes:</label>
                                        <div class="box1">
                                            <span>@isset($customer->delivery_notes){{ $customer->delivery_notes }}@endisset</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        </div>
                    </div>
                    
                </div>
                <br>
            </section>
            <!--  -->
            <div class="row mb-40-wrapper">
                <div class="col-lg-12">
                    <h2 class="heading-tbl" style="margin-left: 10px;">Delivery Items</h2>
                </div>
                <div class="col-lg-4">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" style="position: relative; left: 3%;">
                        <thead>
                                        <tr>
                                            <th class="table-th-wrapper" scope="col">Product</th>
                                            <th class="table-th-wrapper" scope="col">Total Cartons</th>
                                        </tr>
                                    </thead>
                                    <tbody class="week-container-tbl">
                                        @foreach ($product as $product1)
                                        <tr class="week_days_1">
                                            <td class="table-td-wrapper" scope="row" style="background-color: white !important; width: 175px; text-align:center;">
                                                {{ $product1['name'] }}
                                            </td>
                                            <td style="background-color: white !important; width: 175px; text-align:center;">
                                                <div class="quantity">
                                                    {{ $product1['carton'] }}
                                                </div>
                                                @php $total =$total + $product1['carton'] ; @endphp

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                        </table>
                        <table class="table table-bordered mb-0 weekly_standing_order" style="margin-left: 50px;" >
                            <tbody class="week-container-tbl">
                                <tr>
                                    <th style="width: 222px; text-align: center;">Total Carton</th>
                                    <td id="total_ctns">
                                        {{$total}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 text-center">
                    <p class="custom-border-1 xxxx" style="text-align: center; position: relative;  margin-left:20px;">Received in full</p>
                    
                </div>

                <div class="col-lg-4 col-sm-4" style="position: relative; float: right; margin-top: -80px;">
                    <!-- {!! QrCode::size(150)->generate(route('qr.driverScan',['id'=>$customer->id])) !!} -->
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate(route('qr.driverScan',['id'=>$customer->id])))!!}" style="position: relative; margin-top:-140px;"  class="img-fluid" alt="">
                </div>
            </div>
    @endif
        @endforeach  


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
  width: 10%;
  border: 2px solid #00756c;
  left: 51%;

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