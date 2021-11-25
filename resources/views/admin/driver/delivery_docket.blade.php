
<style>
    .qr-area {
        margin-top: 10px;
        margin-bottom: 10px;
        margin-right: 30%;
        margin-left: 20%;
    }
</style>
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="qr-area ">
                <p><b>Milk Kitchen Ltd</b></p>
                <p><b>Delivery Docket</b></p>
                <p>{{$customer->delivery_name}}</p>
                <p>{{date('Y-m-d')}}</p>
                <p>Invoice Ref : {{mt_rand(00011,11111)}}</p>
                @foreach($products as $product)
                <p>{{$product->name}} : {{$product->quantity}} </p>
                @endforeach

                <div class="row text-center">
                    <p>Received by  ______________</p>  
                </div>
                <div class="row-lg-4 pl-5">
                    {!! QrCode::size(60)->generate(route('qr.driverScan',['id'=>$receiverId,'type'=>'deliverydockets'])); !!}
                </div>
            </div>
        </div>
    </div>
</div>

