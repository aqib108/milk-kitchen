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
                <tr class="week_days" data-p-id="{{$product->id}}">
                    <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                    @foreach ($weekDays as $item)
                        @php
                            $qnty = 0;
                            if ($item->orderDelivered->isNotEmpty()){
                                foreach ($item->orderDelivered as $order){
                                    if($order->product_id == $product->id){
                                        $qnty = $order->quantity;
                                    }
                                }
                            }
                        @endphp
                        <td>
                            <input id="{{ $item->name }}" class="form-control" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                            text-align: center;" value="{{ $qnty }}" minlength="0" readonly>
                        </td>
                    @endforeach
                </tr> 
            @endforeach
        </tbody>
    </table>
</div>