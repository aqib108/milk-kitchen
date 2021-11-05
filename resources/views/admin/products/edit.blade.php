@extends('admin.layouts.admin')
@section('title', 'Edit Product')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="btn btn-primary"><i
                                    class="fas fa-arrow-left"></i> Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('product.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                        <label>Price <span class="required-star">*</span></label>
                                        <input  type="text" inputmode="decimal"  class="form-control price" name="price"
                                            placeholder="Enter Product Price" value="{{ $product->price }}" required>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Image <span class="required-star">*</span></label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" id="image_url" class="custom-file-input" name="image_url"
                                                    accept=".png, .jpg, .jpeg" value="{{ $product->image_url }}"> <label
                                                    class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                        @error('image_url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                      
                                        <img src="{{ asset('storage/' . $product->image_url) }}" id="image"
                                            class="w-25 mt-2" />
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Sku<span class="required-star">*</span></label>
                                        <input type="number" maxlength="50"
                                            class="form-control @error('sku') is-invalid @enderror" name="sku"
                                            value="{{ $product->sku }}" placeholder="Enter Product Sku" required>
                                        @error('sku')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>New<span class="required-star">*</span></label>
                                        <select name="new" class="form-control @error('new') is-invalid @enderror" id="">
                                            <option value="1" @if ($product->new == 1){{ 'selected' }}@endif>Yes</option>
                                            <option value="0" @if ($product->new == 0){{ 'selected' }}@endif>No</option>
                                        </select>
                                        @error('new')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Pack Size<span class="required-star">*</span></label>
                                        <input type="number" maxlength="50"
                                            class="form-control price @error('pack_size') is-invalid @enderror" name="pack_size" id="pack_size"
                                            value="{{ $product->pack_size }}" placeholder="Enter Pack Size" required>
                                        @error('pack_size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Active<span class="required-star">*</span></label>
                                        <select name="active" class="form-control @error('active') is-invalid @enderror"
                                            id="">
                                            <option value="1" @if ($product->active == 1){{ 'selected' }}@endif>Yes</option>
                                            <option value="0" @if ($product->active == 0){{ 'selected' }}@endif>No</option>
                                        </select>
                                        @error('active')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6">
                                        <label>Descriptions <span class="required-star">*</span></label>
                                        <textarea name="description" id="description" cols="15" rows="2"
                                            class="form-control text-area">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <table class="table table-sm table-bordered">
                                            <tr style="background-color:#95d60c !important;color:white;">
                                                <th>Heading</th>
                                                <th>CTN Price</th>
                                                <th>Bottle Price</th>
                                                <th>Saleable in the market</th>
                                            </tr>
                                            @foreach ($groups as $grp)
                                            @php $id=0;$ctn=0;$bottle=0; @endphp
                                             <tr>
                                                <td>{{ $grp->group_name }}</td>
                                                <td>
                                                    <input type="hidden" value="{{ $grp->id }}" name="group_id[]">
                                                    @foreach ($services as $ser)
                                                        @if ($ser->group_id == $grp->id)
                                                            @php $id = $ser->id; @endphp
                                                        @break
                                                        @endif
                                                    @endforeach
                                                    <input type="hidden" value="{{ $id }}" name="service_id[]">
                                                    
                                                    @foreach ($services as $ser)
                                                        @if ($ser->group_id == $grp->id)
                                                            @php $ctn = $ser->ctn_price; @endphp
                                                        @break
                                                        @endif
                                                    @endforeach
                                                    <input type="text" maxlength="100" class="form-control price ctnPrice" name="ctn_price[]"
                                                    id="ctnPrice-{{$grp->id}}" data-id="{{$grp->id}}" placeholder="Enter Ctn Price"
                                                    value="{{ $ctn }}">
                                                </td>
                                                <td>
                                                    @foreach ($services as $ser)
                                                        @if ($ser->group_id == $grp->id)
                                                            @php $bottle = $ser->bottle_price; @endphp
                                                        @break
                                                        @endif
                                                    @endforeach
                                                    <input type="text" maxlength="100" class="form-control price bottlePrice" name="bottle_price[]"
                                                    id="bottlePrice-{{$grp->id}}" data-id="{{$grp->id}}" placeholder="Enter Bottle Price"
                                                    value="{{ $bottle }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-control" value="1"
                                                        name="saleable[]" data-size="xs" data-toggle="toggle"
                                                    @foreach ($services as $ser)
                                                        @if ($ser->group_id == $grp->id)
                                                            @if ($ser->saleable == 1)
                                                                {{ 'checked' }}
                                                            @endif
                                                        @endif
                                                    @endforeach>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').removeClass("hidden");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_url").change(function() {
            readURL(this);
        });

        // Get Input File Name
        $('.custom-file input').change(function(e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(','));
        });

        $(document).on('change', '.ctnPrice',function () {
            var id = $(this).data('id');
            var ctn_price = $('#ctnPrice-'+id).val();     
            var pack_size = $('#pack_size').val();
            var value = ctn_price / pack_size;
            var B_value = value.toFixed(2)
            $('#bottlePrice-'+id).val(B_value);
        });
    </script>
@endsection
