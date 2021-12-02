<div class="table-responsive">
    <table class="table table-bordered mb-0 weekly_standing_order">
        <thead>
            <tr>
                <th class="table-th-wrapper" scope="col">Product Name</th>
                <th class="table-th-wrapper" scope="col">Monday</th>
                <th class="table-th-wrapper" scope="col">Tuesday</th>
                <th class="table-th-wrapper" scope="col">Wednesday</th>
                <th class="table-th-wrapper" scope="col">Thursday</th>
                <th class="table-th-wrapper" scope="col">Friday</th>
                <th class="table-th-wrapper" scope="col">Saturday</th>
                <th class="table-th-wrapper" scope="col">Sunday</th>
            </tr>
        </thead>
        <tbody class="week-container-tbl">
            @foreach ($products as $product)
                <tr class="week_days" data-p-id="{{$product['id']}}">
                    <td class="table-td-wrapper" scope="row" style="width: 149px; background-color: white !important;">{{$product['name']}}</td>
                    @foreach ($weekDays as $item)
                        @php
                            $qnty = 0;
                            if ($item->productOrder->isNotEmpty()){
                                foreach ($item->productOrder as $order){
                                   if($order->user_id == $customerID){
                                        if($order->product_id == $product['id']){
                                            $qnty = $order->quantity;
                                        }
                                    } 
                                }
                            }
                        @endphp
                        @if($qnty != null)
                            <td style="background-color: white !important; width: 149px;">
                                <input id="{{ $item->name }}" class="form-control" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                text-align:center;  margin: auto;" value="{{ $qnty }}" minlength="0" readonly>
                                
                            </td>
                        @else
                            <td style="background-color: aliceblue !important; width: 149px;">
                                <input id="{{ $item->name }}" class="form-control" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                text-align:center;  margin: auto;" value="{{ $qnty }}" minlength="0" readonly>
                            </td>
                        @endif
                    @endforeach
                </tr> 
            @endforeach
        </tbody>
    </table>
    <table class="table table-bordered mb-0 weekly_standing_order">
        <tbody class="week-container-tbl"> 
      
            <tr>
                <td style="width: 145px;"></td>
                
                @foreach ($weekDays as $item)
                    @php
                        $id = 0;
                        if ($item->productOrder->isNotEmpty()){
                            foreach ($item->productOrder as $order){
                                if($order->user_id == $customerID){
                                    if($order->day_id == $item->id){
                                        $id = $order->id;
                                    }
                                }
                            }
                        }
                    @endphp
                    @if($id != 0)
                        <td style="width: 149px;">
                            <a href="{{route('customer.final-report',[$id,$customerID,$startDate,$endDate])}}">view</a>
                        </td>
                    @else
                        <td style="background-color: aliceblue !important; width: 149px;">
                            <a href="{{route('customer.final-report',[$id,$customerID])}}"></a>
                        </td>
                    @endif
                   
                @endforeach 
               
            </tr>
        
        </tbody>
    </table>  
</div>