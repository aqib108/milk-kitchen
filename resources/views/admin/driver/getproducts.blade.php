@foreach($products as $product)

<label>{{$product->name}}<span class="required-star">*</span></label>
                                        <input type="number" maxlength="50"
                                            class="form-control" name="quantity[]" id="quantity"
                                             placeholder="Enter {{$product->name}} Quantity" required>
                                             <div id="email-err" class="alert alert-danger"></div>
                                 

<input type="hidden" name="productIds[]" value="{{$product->id}}">


@endforeach
<script type="text/javascript">
    var region = '';
    region = `<?php echo $deliveryRegion ?? ''; ?>`;

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.weekly_standing_order .week_days td input').on('change', function() {
            let product_id = $(this).parent('td').parent('tr').attr('data-p-id');
            let day_id = $(this).attr('data-id');
            let qnty = $(this).val();
            if (qnty < 0) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000,
                    icon: 'error',
                    title: 'Quantity should not be less than 0',
                });
                $(this).val(0);
            } else {
                $.ajax({
                    type: "POST",
                    data: {
                        'day_id': day_id,
                        'product_id': product_id,
                        'region': region,
                        'qnty': qnty
                    },
                    url: "{{route('admin.customer-orders',$customer->id)}}",
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.message,
                            });
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'error',
                                title: response.success,
                            });
                        }
                    },
                });
            }
        });
    });
</script>