@extends('admin.layouts.admin')
@section('title', 'Run Picklist')

<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8">
        <div class="qr-area ">

        <h2><b>Order completed Successfully</b></h2>
       
</div>
        </div>
        <div class="col-md-4">
            
        </div>
        <div class="row">
            <div class="col-md-10 mt-5">
            <!-- target="_blank" href="{{route('printDeliveryDocket',encrypt($customer))}}" style="color:blanchedalmond;padding:25px" -->
            <button type="button" class="btn btn-lg btn-success" onclick="print()" ><a >Get Slip Of Deliverd Dockets</a></button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var url = `<?php echo route('printDeliveryDocket',encrypt($customer)) ;?>` ;
    function print() {
      
        var WinPrint = window.open(url, '', 'left=0,top=0,width=384,height=900,toolbar=0,scrollbars=0,status=0');
// WinPrint.document.write('<html><head>');
// WinPrint.document.write('<link rel="stylesheet" href="assets/css/print/normalize.css">');
// WinPrint.document.write('<link rel="stylesheet" href="assets/css/print/receipt.css">');
// WinPrint.document.write('</head><body onload="print();close();">');
// WinPrint.document.write(prtContent.innerHTML);
// WinPrint.document.write('</body></html>');
WinPrint.document.close();
WinPrint.focus();
    }
</script>
@endsection