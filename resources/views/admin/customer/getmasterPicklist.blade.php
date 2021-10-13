<div class="row mb-40-wrapper">
    <div class="col-lg-12">
        <h2 class="heading-tbl">Warehouses Picklist</h2>
    </div>
    <div class="col-lg-10">
        <div class="table-responsive" style="overflow: hidden;">
         
            <table class="table table-bordered mb-0">
                <thead>
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="table-th-wrapper pb-2" scope="col">Warehouse</h4>
                            <h5 class="ml-5">{{$warehouse->name}}</h5>
                        </div>
                      
                    </div>

                    <tr>
                        <th class="table-th-wrapper" scope="col">Product</th>
                        <th class="table-th-wrapper" scope="col">Total Cartons</th>
                        <th class="table-th-wrapper" scope="col">Picked</th>
                    </tr>
                </thead>
                <tbody class="week-container-tbl">
                    @php $total = 0; @endphp
                    @forelse($products as $product)
                    <tr class="week_days">
                        <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                        <td>{{$product->carton}}</td>
                        <td></td>
                        @php $total += $product->corton @endphp
                    </tr>
                    @if($total > 0 && $loop->last)
                    <tr>
                        <td>Total Cortons</td>
                        <td>{{ $total }}</td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                    <td class="alert alert-danger" colspan="4" role="alert">
                            <div>
                                No Result(s) Found !
                            </div>
                        </td>
                    </tr>
                    @endforelse
             
                </tbody>
            </table>
          
        </div>
    </div>
</div>