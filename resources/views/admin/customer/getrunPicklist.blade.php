<div class="col-lg-12">
    <h2 class="heading-tbl">Warehouses Picklist</h2>
</div> <br>
 <div class="row">
    <div class="col-md-4">
        <div class="warehouse border text-center">
            <h3 class="table-th-wrapper">Warehouse</h3>
            <p>{{$warehouse->name}}</p>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="warehouse border text-center">
            <h3 class="table-th-wrapper">Delivery Date</h3>
            <p>2/10/2021 (saturday)</p>
        </div>
    </div>
</div>
<div class="row py-3">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th class="table-th-wrapper" scope="col">CUSTOMER</th>
                <th class="table-th-wrapper" scope="col">ADRESS</th>
                <th class="table-th-wrapper" scope="col">SUBRUB</th>
                <th  class="table-th-wrapper"scope="col">CARTONS</th>
              </tr>
            </thead>
            <tbody class="week-container-tbl">
                @php $total = 0; @endphp
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <tr>
                            <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                            <td>{{$product->address}}</td>
                            <td>{{$product->subrub}}</td>
                            <td>{{$product->cartons}}</td> 
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="alert alert-danger" colspan="4" role="alert">
                            <div>
                                No Result(s) Found !
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table> 
    </div>
</div>








                   
{{--                    
                    <tr class="week_days">
                       
                        @php $total += $product->cartons @endphp
                    </tr>
                    @empty
                    <tr>
                        <td class="p-5">
                            No record
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
</div> --}}