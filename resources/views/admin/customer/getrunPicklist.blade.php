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
            <p>{{date('m/d/Y', strtotime($date))}} - <b>({{$current_day}})</b></p>
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
                @foreach($products as $customers)
                    @if($customers->count() > 0)
                        @foreach($customers as $customer)
                            
                                <tr>
                                    <td class="table-td-wrapper" scope="row">{{$customer->name}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->subrub}}</td>
                                    <td>{{$customer->cartons}}</td> 
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
                @endforeach
            </tbody>
        </table> 
    </div>
</div>